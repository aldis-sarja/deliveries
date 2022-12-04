<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Services\Client\GetAllClientsService;
use App\Services\Client\GetClientAddressesService;
use App\Services\Client\GetClientByIdService;
use App\Services\Client\GetClientsByDifferentDeliveriesService;
use App\Services\Client\GetClientsByFilterService;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    private GetAllClientsService $getAllClientsService;
    private GetClientByIdService $getClientByIdService;
    private GetClientsByDifferentDeliveriesService $getClientsByDifferentDeliveriesService;
    private GetClientsByFilterService $getClientsByFilterService;
    private GetClientAddressesService $getClientAddressesService;

    public function __construct(
        GetAllClientsService                   $getAllClientsService,
        GetClientByIdService                   $getClientByIdService,
        GetClientsByDifferentDeliveriesService $getClientsByDifferentDeliveriesService,
        GetClientsByFilterService              $getClientsByFilterService,
        GetClientAddressesService              $getClientAddressesService
    )
    {
        $this->getAllClientsService = $getAllClientsService;
        $this->getClientByIdService = $getClientByIdService;
        $this->getClientsByDifferentDeliveriesService = $getClientsByDifferentDeliveriesService;
        $this->getClientsByFilterService = $getClientsByFilterService;
        $this->getClientAddressesService = $getClientAddressesService;
    }

    public function index(): JsonResponse
    {
        try {
            return cache()->remember("AllClients", self::CACHE_TIME, function () {
                return response()->json($this->getAllClientsService->execute());
            });
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return cache()->remember("Client:" . $id, self::CACHE_TIME, function () use ($id) {
                return response()->json($this->getClientByIdService->execute($id));
            });
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function getAddresses(int $id): JsonResponse
    {
        try {
            return cache()->remember("Client:Addresses:" . $id, self::CACHE_TIME, function () use ($id) {
                return response()->json($this->getClientAddressesService->execute($id));
            });
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function getDifferentDeliveries(): JsonResponse
    {
        try {
            return cache()->remember("Different", self::CACHE_TIME, function () {
                return response()->json(
                    $this->getClientsByDifferentDeliveriesService->execute()
                );
            });
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function getClientsByFilter(ClientRequest $request): JsonResponse
    {
        if ($request->get('noliquid')) {
            $filter[] = 'noliquid';
        }

        if ($filter) {
            try {
                return cache()->remember("Filtered:" . join(',', $filter), self::CACHE_TIME, function () use ($filter) {
                    return response()->json($this->getClientsByFilterService->execute($filter));
                });
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 404);
            }
        }
        return response()->json(['error' => 'Unknown filter'], 404);
    }
}
