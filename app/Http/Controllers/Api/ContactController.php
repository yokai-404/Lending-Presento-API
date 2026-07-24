<?php

namespace App\Http\Controllers\Api;

use App\DTO\ContactDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Services\Contact\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;
use Throwable;

#[OA\Tag(
    name: 'Contact Form',
    description: 'API для отправки формы обратной связи с AI-анализом и email уведомлениями'
)]
class ContactController extends Controller
{
    public function __construct(
        private readonly ContactService $contactService,
    ) {
    }

    #[OA\Post(
        path: '/api/contact',
        operationId: 'createContact',
        summary: 'Отправка формы обратной связи',
        description: 'Принимает данные формы, выполняет валидацию, AI-анализ комментария, сохраняет обращение и отправляет email уведомления.',
        tags: ['Contact Form'],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Данные формы обратной связи',
            content: new OA\JsonContent(
                required: [
                    'name',
                    'email',
                    'phone',
                    'message',
                ],
                properties: [
                    new OA\Property(
                        property: 'name',
                        description: 'Имя клиента',
                        type: 'string',
                        example: 'Иван Иванов'
                    ),

                    new OA\Property(
                        property: 'email',
                        description: 'Email клиента',
                        type: 'string',
                        format: 'email',
                        example: 'ivan@example.com'
                    ),

                    new OA\Property(
                        property: 'phone',
                        description: 'Телефон клиента',
                        type: 'string',
                        example: '+79991234567'
                    ),

                    new OA\Property(
                        property: 'message',
                        description: 'Комментарий клиента',
                        type: 'string',
                        minLength: 10,
                        example: 'Здравствуйте! Хотел бы заказать разработку сайта.'
                    ),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Обращение успешно создано',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'success',
                            type: 'boolean',
                            example: true
                        ),

                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Ваше обращение успешно отправлено.'
                        ),

                        new OA\Property(
                            property: 'data',
                            type: 'object',
                            properties: [
                                new OA\Property(
                                    property: 'uuid',
                                    type: 'string',
                                    example: '019f9007-cbe3-7177-8773-73d19a1e86ac'
                                ),

                                new OA\Property(
                                    property: 'created_at',
                                    type: 'string',
                                    format: 'date-time',
                                    example: '2026-07-24T05:59:58+03:00'
                                ),

                                new OA\Property(
                                    property: 'ai_analysis',
                                    type: 'object',
                                    description: 'Результат AI анализа обращения',
                                    properties: [
                                        new OA\Property(
                                            property: 'sentiment',
                                            type: 'string',
                                            example: 'positive'
                                        ),

                                        new OA\Property(
                                            property: 'category',
                                            type: 'string',
                                            example: 'development'
                                        ),

                                        new OA\Property(
                                            property: 'priority',
                                            type: 'string',
                                            example: 'high'
                                        ),
                                    ]
                                ),
                            ]
                        ),
                    ]
                )
            ),

            new OA\Response(
                response: 422,
                description: 'Ошибка валидации',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Введите корректный email.'
                        ),

                        new OA\Property(
                            property: 'errors',
                            type: 'object',
                            example: [
                                'email' => [
                                    'Введите корректный email.',
                                ],
                                'phone' => [
                                    'Телефон слишком короткий.',
                                ],
                            ]
                        ),
                    ]
                )
            ),

            new OA\Response(
                response: 429,
                description: 'Превышен лимит запросов',
                content: new OA\JsonContent(
                    example: [
                        'message' => 'Too Many Requests',
                    ]
                )
            ),

            new OA\Response(
                response: 500,
                description: 'Внутренняя ошибка сервера',
                content: new OA\JsonContent(
                    example: [
                        'success' => false,
                        'message' => 'Произошла внутренняя ошибка сервера.',
                    ]
                )
            ),
        ]
    )]
    public function store(ContactRequest $request): JsonResponse
    {
        try {
            $dto = ContactDTO::fromArray([
                ...$request->validated(),

                'ip_address' => $request->ip(),

                'user_agent' => $request->userAgent()
                    ?? 'Unknown',
            ]);

            $contact = $this->contactService->create($dto);

            return response()->json([
                'success' => true,

                'message' => 'Ваше обращение успешно отправлено.',

                'data' => [
                    'uuid' => $contact->uuid,

                    'created_at' => $contact->created_at,

                    'ai_analysis' => [
                        'sentiment' => $contact->sentiment ?? null,
                        'category' => $contact->category ?? null,
                        'priority' => $contact->priority ?? null,
                    ],
                ],
            ], 201);
        } catch (Throwable $exception) {
            Log::error(
                'Contact form processing failed',
                [
                    'message' => $exception->getMessage(),

                    'file' => $exception->getFile(),

                    'line' => $exception->getLine(),

                    'ip' => $request->ip(),
                ]
            );

            return response()->json([
                'success' => false,

                'message' => 'Произошла внутренняя ошибка сервера.',
            ], 500);
        }
    }
}
