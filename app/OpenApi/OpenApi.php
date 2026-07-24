<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Lending Presento API',
    description: 'Backend API для формы обратной связи с AI-интеграцией.'
)]
#[OA\Server(
    url: 'http://127.0.0.1:8000',
    description: 'Local Development'
)]

#[OA\Tag(
    name: 'Contact',
    description: 'Работа с формой обратной связи'
)]
#[OA\Tag(
    name: 'Monitoring',
    description: 'Системные эндпоинты'
)]
class OpenApi
{
}
