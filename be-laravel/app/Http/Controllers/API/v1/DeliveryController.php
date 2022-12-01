<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\Delivery\GetLastDeliveriesService;
use Illuminate\Http\JsonResponse;

class DeliveryController extends Controller
{
    private GetLastDeliveriesService $getLastDeliveriesService;

    public function __construct(GetLastDeliveriesService $getLastDeliveriesService)
    {
        $this->getLastDeliveriesService = $getLastDeliveriesService;
    }

    public function getLastDeliveries(): JsonResponse
    {
        try {
            return cache()->remember("LastDeliveries", self::CACHE_TIME, function () {
                return response()->json(
                    $this->getLastDeliveriesService->execute()
                );
            });
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
