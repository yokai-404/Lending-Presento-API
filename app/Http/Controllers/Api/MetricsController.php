<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Metrics\MetricsService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class MetricsController extends Controller
{
    public function __construct(
        private readonly MetricsService $metricsService,
    ) {}

    #[OA\Get(
        path: '/api/metrics',
        operationId: 'metrics',
        summary: 'Статистика обращений',
        description: 'Возвращает агрегированную статистику по обращениям.',
        tags: ['Monitoring'],
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
                            properties: [
                                new OA\Property(
                                    property: 'total_contacts',
                                    type: 'integer',
                                    example: 120
                                ),
                                new OA\Property(
                                    property: 'today_contacts',
                                    type: 'integer',
                                    example: 8
                                ),
                                new OA\Property(
                                    property: 'positive',
                                    type: 'integer',
                                    example: 70
                                ),
                                new OA\Property(
                                    property: 'neutral',
                                    type: 'integer',
                                    example: 35
                                ),
                                new OA\Property(
                                    property: 'negative',
                                    type: 'integer',
                                    example: 15
                                ),
                                new OA\Property(
                                    property: 'categories',
                                    type: 'object',
                                    example: [
                                        'question' => 55,
                                        'order' => 30,
                                        'complaint' => 12,
                                        'other' => 23,
                                    ]
                                ),
                            ],
                            type: 'object'
                        ),
                    ]
                )
            ),
        ]
    )]
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->metricsService->get(),
        ]);
    }
}
