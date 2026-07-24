<?php

namespace App\Services\AI;

use App\Contracts\AIServiceInterface;
use App\DTO\ContactDTO;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;
use Throwable;

class OpenAIService implements AIServiceInterface
{
    public function analyze(ContactDTO $dto): array
    {
        try {
            $startedAt = microtime(true);
            $response = OpenAI::chat()->create([
                'model' => 'gpt-4.1-mini',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => <<<'PROMPT'
                    Ты — AI-помощник backend CRM.

                    Проанализируй обращение пользователя.

                    Определи:

                    1. sentiment
                    Возможные значения:
                    positive
                    neutral
                    negative

                    2. category

                    Возможные значения:

                    sales
                    support
                    partnership
                    other

                    3. reply

                    Напиши короткий профессиональный ответ
                    не длиннее 300 символов.

                    Требования:

                    — ответ должен быть дружелюбным
                    — не обещай невозможного
                    — не придумывай информацию
                    — обращайся на "Вы"
                    — если пользователь хочет заказать разработку —
                    предложи связаться с ним

                    Верни ТОЛЬКО JSON.

                    Структура:

                    {
                        "sentiment":"...",
                        "category":"...",
                        "reply":"..."
                    }

                    Никакого markdown.
                    Никаких пояснений.
                    Никакого текста вне JSON.
                    PROMPT
                    ],
                    [
                        'role' => 'user',
                        'content' => $dto->message,
                    ],
                ],
                'temperature' => 0.2,
                'max_tokens' => 200,
            ]);

            $content = $response->choices[0]->message->content;
            $duration = round((microtime(true) - $startedAt) * 1000);
            $data = json_decode($content, true);

            if (! is_array($data)) {
                throw new \RuntimeException('OpenAI returned invalid JSON.');
            }

            return [
                'sentiment' => $data['sentiment'] ?? 'neutral',
                'category' => $data['category'] ?? 'other',
                'ai_reply' => $data['reply'] ?? '',
            ];
        } catch (Throwable $e) {
            Log::error('OpenAI Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'sentiment' => 'neutral',
                'category' => 'other',
                'ai_reply' => 'Спасибо за обращение! Мы свяжемся с вами в ближайшее время.',
            ];
        }
    }
}
