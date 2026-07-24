<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class HealthController
{
    public function __invoke(): JsonResponse
    {
        $databaseStatus = 'ok';

        try {
            DB::connection()->getPdo();
        } catch (\Throwable) {
            $databaseStatus = 'error';
        }

        return response()->json([
            'success' => true,
            'status' => 'ok',

            'service' => [
                'name' => config('app.name'),
                'version' => env('APP_VERSION', '1.0.0'),
            ],

            'services' => [

                'database' => [
                    'status' => $databaseStatus,
                    'driver' => config('database.default'),
                ],

                'mail' => [
                    'status' => config('mail.default') ? 'ok' : 'error',
                    'driver' => config('mail.default'),
                ],

                'ai' => [
                    'status' => 'ok',
                    'driver' => config('services.ai.driver', 'fake'),
                    'model' => config('services.ai.model', 'gpt-4.1-mini'),
                ],
            ],

            'environment' => [
                'app' => app()->environment(),
                'php' => PHP_VERSION,
                'laravel' => app()->version(),
            ],

            'timestamp' => now()->toIso8601String(),
        ]);
    }
}