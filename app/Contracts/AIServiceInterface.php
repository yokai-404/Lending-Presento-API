<?php

namespace App\Contracts;

use App\DTO\ContactDTO;

interface AIServiceInterface
{
    /**
     * Анализирует обращение пользователя.
     *
     * @return array{
     *     sentiment:string,
     *     category:string,
     *     reply:string
     * }
     */
    public function analyze(ContactDTO $dto): array;
}
