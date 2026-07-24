<?php

namespace App\Providers;

use App\Contracts\AIServiceInterface;
use App\Contracts\ContactRepositoryInterface;
use App\Repositories\ContactRepository;
use App\Services\AI\FallbackAIService;
use App\Services\AI\OpenAIService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ContactRepositoryInterface::class,
            ContactRepository::class
        );

        $this->app->bind(
            AIServiceInterface::class,
            function () {
                return match (config('services.ai.driver')) {
                    'openai' => new OpenAIService,
                    default => new FallbackAIService,
                };
            }
        );
    }

    public function boot(): void
    {
        //
    }
}
