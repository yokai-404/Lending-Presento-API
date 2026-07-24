<?php

namespace App\Http\Controllers\Api;

use App\DTO\ContactDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Services\Contact\ContactService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class ContactController extends Controller
{
    public function __construct(
        private readonly ContactService $contactService,
    ) {}

    #[OA\Post(
        path: '/api/contact',
        operationId: 'createContact',
        summary: 'Отправка формы обратной связи',
        description: 'Принимает данные формы обратной связи, выполняет AI-анализ, сохраняет обращение и отправляет email-уведомления.',
        tags: ['Contact Form'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'email', 'phone', 'message'],
                properties: [
                    new OA\Property(
                        property: 'name',
                        type: 'string',
                        example: 'Иван Иванов'
                    ),
                    new OA\Property(
                        property: 'email',
                        type: 'string',
                        format: 'email',
                        example: 'ivan@example.com'
                    ),
                    new OA\Property(
                        property: 'phone',
                        type: 'string',
                        example: '+79991234567'
                    ),
                    new OA\Property(
                        property: 'message',
                        type: 'string',
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
                            properties: [
                                new OA\Property(
                                    property: 'uuid',
                                    type: 'string',
                                    example: '019f9007-cbe3-7177-8773-73d19a1e86ac'
                                ),
                                new OA\Property(
                                    property: 'created_at',
                                    type: 'string',
                                    format: 'date-time'
                                ),
                            ],
                            type: 'object'
                        ),
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Ошибка валидации'
            ),
            new OA\Response(
                response: 429,
                description: 'Превышен лимит запросов'
            ),
            new OA\Response(
                response: 500,
                description: 'Внутренняя ошибка сервера'
            ),
        ]
    )]
    public function store(ContactRequest $request): JsonResponse
    {
        $dto = ContactDTO::fromArray([
            ...$request->validated(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent() ?? 'Unknown',
        ]);

        $contact = $this->contactService->create($dto);

        return response()->json([
            'success' => true,
            'message' => 'Ваше обращение успешно отправлено.',
            'data' => [
                'uuid' => $contact->uuid,
                'created_at' => $contact->created_at,
            ],
        ], 201);
    }
}
