<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;
use Throwable;

#[OA\Tag(
    name: 'Health',
    description: 'Проверка состояния API и зависимых сервисов'
)]
class HealthController
{
    #[OA\Get(
        path: '/api/health',
        operationId: 'healthCheck',
        summary: 'Проверка состояния сервиса',
        description: 'Возвращает статус приложения, базы данных, почты, AI-сервиса и версии окружения.',
        tags: [
            'Health',
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Сервис работает',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'success',
                            type: 'boolean',
                            example: true
                        ),

                        new OA\Property(
                            property: 'status',
                            type: 'string',
                            example: 'ok'
                        ),

                        new OA\Property(
                            property: 'service',
                            type: 'object',
                            properties: [
                                new OA\Property(
                                    property: 'name',
                                    type: 'string',
                                    example: 'Lending Presento API'
                                ),

                                new OA\Property(
                                    property: 'version',
                                    type: 'string',
                                    example: '1.0.0'
                                ),
                            ]
                        ),

                        new OA\Property(
                            property: 'services',
                            type: 'object'
                        ),

                        new OA\Property(
                            property: 'environment',
                            type: 'object'
                        ),

                        new OA\Property(
                            property: 'timestamp',
                            type: 'string',
                            format: 'date-time'
                        ),
                    ]
                )
            ),

            new OA\Response(
                response: 500,
                description: 'Ошибка проверки состояния сервиса'
            ),
        ]
    )]
    public function __invoke(): JsonResponse
    {
        try {
            $databaseStatus = 'ok';

            try {
                DB::connection()->getPdo();
            } catch (Throwable $exception) {
                $databaseStatus = 'error';

                Log::error(
                    'Health check database failed',
                    [
                        'message' => $exception->getMessage(),
                    ]
                );
            }

            $aiDriver = config(
                'services.ai.driver',
                'fake'
            );

            $aiModel = config(
                'services.ai.model',
                'gpt-4.1-mini'
            );

            return response()->json([
                'success' => true,

                'status' => 'ok',

                'service' => [
                    'name' => config(
                        'app.name',
                        'Lending Presento API'
                    ),

                    'version' => env(
                        'APP_VERSION',
                        '1.0.0'
                    ),
                ],

                'services' => [
                    'database' => [
                        'status' => $databaseStatus,

                        'driver' => config(
                            'database.default'
                        ),
                    ],

                    'mail' => [
                        'status' => config('mail.default')
                            ? 'ok'
                            : 'error',

                        'driver' => config(
                            'mail.default'
                        ),
                    ],

                    'ai' => [
                        'status' => $aiDriver
                            ? 'ok'
                            : 'error',

                        'driver' => $aiDriver,

                        'model' => $aiModel,
                    ],
                ],

                'environment' => [
                    'app' => app()->environment(),

                    'php' => PHP_VERSION,

                    'laravel' => app()->version(),
                ],

                'timestamp' => now()->toIso8601String(),
            ], 200);
        } catch (Throwable $exception) {
            Log::error(
                'Health endpoint failed',
                [
                    'message' => $exception->getMessage(),

                    'file' => $exception->getFile(),

                    'line' => $exception->getLine(),
                ]
            );

            return response()->json([
                'success' => false,

                'status' => 'error',

                'message' => 'Health check failed',
            ], 500);
        }
    }
}
