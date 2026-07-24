<?php

namespace App\Services\AI;

use App\Contracts\AIServiceInterface;
use App\DTO\ContactDTO;

class FallbackAIService implements AIServiceInterface
{
    public function analyze(ContactDTO $dto): array
    {
        $message = mb_strtolower($dto->message);

        if (
            str_contains($message, 'купить') ||
            str_contains($message, 'заказать') ||
            str_contains($message, 'стоимость') ||
            str_contains($message, 'цена')
        ) {
            return [
                'sentiment' => 'positive',
                'category' => 'sales',
                'ai_reply' => 'Спасибо за интерес! Мы подготовим коммерческое предложение и свяжемся с вами.',
            ];
        }

        if (
            str_contains($message, 'ошибка') ||
            str_contains($message, 'не работает') ||
            str_contains($message, 'проблема')
        ) {
            return [
                'sentiment' => 'negative',
                'category' => 'support',
                'ai_reply' => 'Спасибо за сообщение. Наша команда уже рассматривает вашу проблему.',
            ];
        }

        if (
            str_contains($message, 'партнер') ||
            str_contains($message, 'сотрудничество') ||
            str_contains($message, 'collaboration')
        ) {
            return [
                'sentiment' => 'positive',
                'category' => 'partnership',
                'ai_reply' => 'Спасибо! Мы заинтересованы в сотрудничестве и скоро свяжемся с вами.',
            ];
        }

        return [
            'sentiment' => 'neutral',
            'category' => 'other',
            'ai_reply' => 'Спасибо за обращение! Мы ответим вам в ближайшее время.',
        ];
    }
}
