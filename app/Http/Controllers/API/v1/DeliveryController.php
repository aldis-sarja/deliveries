<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\Delivery\GetLastDeliveriesService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class DeliveryController extends Controller
{
    public function getLastDeliveries(
        GetLastDeliveriesService $getLastDeliveriesService
    ): JsonResponse
    {
        try {
                return response()->json(
                    $getLastDeliveriesService->execute()
                );
        } catch (QueryException | ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
