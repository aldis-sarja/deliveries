<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\Client\GetAllClientsService;
use App\Services\Client\GetClientAddressesService;
use App\Services\Client\GetClientByIdService;
use App\Services\Client\GetClientsByDifferentDeliveriesService;
use App\Services\Client\GetClientsWithoutLiquidDeliveriesService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    public function index(GetAllClientsService $getAllClientsService): JsonResponse
    {
        try {
            return response()->json($getAllClientsService->execute());

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function show(int $id, GetClientByIdService $getClientByIdService): JsonResponse
    {
        try {
            return response()->json($getClientByIdService->execute($id));

        } catch (QueryException|ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function getAddresses(
        int $id,
        GetClientAddressesService $getClientAddressesService
    ): JsonResponse
    {
        try {
            return response()->json($getClientAddressesService->execute($id));

        } catch (QueryException|ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function getDifferentDeliveries(
        GetClientsByDifferentDeliveriesService $getClientsByDifferentDeliveriesService
    ): JsonResponse
    {
        try {
            return response()->json(
                $getClientsByDifferentDeliveriesService->execute()
            );
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function getClientsWithoutLiquidDeliveries(
        GetClientsWithoutLiquidDeliveriesService $getClientsWithoutLiquidDeliveriesService
    ): JsonResponse
    {
        try {
            return response()->json(
                $getClientsWithoutLiquidDeliveriesService->execute()
            );
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
