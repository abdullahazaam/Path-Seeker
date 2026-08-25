<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class HealthController extends Controller
{
    /**
     * System & Service Health-Check API Endpoint.
     */
    public function check(): JsonResponse
    {
        $dbStatus = 'disconnected';
        try {
            DB::connection()->getPdo();
            $dbStatus = 'connected';
        } catch (\Throwable $e) {
            $dbStatus = 'error: ' . $e->getMessage();
        }

        $isHealthy = $dbStatus === 'connected';

        return response()->json([
            'status' => $isHealthy ? 'healthy' : 'degraded',
            'database' => $dbStatus,
            'environment' => config('app.env'),
            'php_version' => PHP_VERSION,
            'timestamp' => now()->toIso8601String(),
        ], $isHealthy ? 200 : 503);
    }
}
