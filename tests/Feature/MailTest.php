<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase
{
    use RefreshDatabase;

    public function test_emails_are_sent(): void
    {
        Mail::fake();

        $response = $this->postJson('/api/contact', [
            'name' => 'Иван',
            'email' => 'ivan@test.ru',
            'phone' => '+79991234567',
            'message' => 'Хочу заказать разработку сайта.',
        ]);

        $response->assertCreated();

        Mail::assertSent(ContactOwnerMail::class);

        Mail::assertSent(ContactUserMail::class);
    }
}
