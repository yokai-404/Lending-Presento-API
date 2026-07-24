<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Metrics\MetricsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;
use Throwable;

#[OA\Tag(
    name: 'Monitoring',
    description: 'Эндпоинты мониторинга и статистики работы сервиса'
)]
class MetricsController extends Controller
{
    public function __construct(
        private readonly MetricsService $metricsService,
    ) {
    }

    #[OA\Get(
        path: '/api/metrics',
        operationId: 'metrics',
        summary: 'Получение статистики обращений',
        description: 'Возвращает агрегированную статистику по обращениям пользователей, включая количество обращений и AI-анализ сообщений.',
        tags: [
            'Monitoring',
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Статистика успешно получена',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'success',
                            type: 'boolean',
                            example: true
                        ),

                        new OA\Property(
                            property: 'data',
                            type: 'object',
                            properties: [
                                new OA\Property(
                                    property: 'total_contacts',
                                    description: 'Общее количество обращений',
                                    type: 'integer',
                                    example: 120
                                ),

                                new OA\Property(
                                    property: 'today_contacts',
                                    description: 'Количество обращений за текущий день',
                                    type: 'integer',
                                    example: 8
                                ),

                                new OA\Property(
                                    property: 'positive',
                                    description: 'Количество позитивных сообщений',
                                    type: 'integer',
                                    example: 70
                                ),

                                new OA\Property(
                                    property: 'neutral',
                                    description: 'Количество нейтральных сообщений',
                                    type: 'integer',
                                    example: 35
                                ),

                                new OA\Property(
                                    property: 'negative',
                                    description: 'Количество негативных сообщений',
                                    type: 'integer',
                                    example: 15
                                ),

                                new OA\Property(
                                    property: 'categories',
                                    description: 'Распределение обращений по категориям',
                                    type: 'object',
                                    example: [
                                        'question' => 55,
                                        'order' => 30,
                                        'complaint' => 12,
                                        'other' => 23,
                                    ]
                                ),
                            ]
                        ),
                    ]
                )
            ),

            new OA\Response(
                response: 500,
                description: 'Ошибка получения статистики',
                content: new OA\JsonContent(
                    example: [
                        'success' => false,
                        'message' => 'Не удалось получить статистику обращений.',
                    ]
                )
            ),
        ]
    )]
    public function __invoke(): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,

                'data' => $this->metricsService->get(),
            ], 200);
        } catch (Throwable $exception) {
            Log::error(
                'Ошибка получения статистики обращений',
                [
                    'message' => $exception->getMessage(),

                    'file' => $exception->getFile(),

                    'line' => $exception->getLine(),
                ]
            );

            return response()->json([
                'success' => false,

                'message' => 'Не удалось получить статистику обращений.',
            ], 500);
        }
    }
}
