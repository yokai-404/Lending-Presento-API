<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_can_be_created(): void
    {
        Mail::fake();

        $response = $this->postJson('/api/contact', [
            'name' => 'Иван Иванов',
            'email' => 'ivan@test.ru',
            'phone' => '+79991234567',
            'message' => 'Здравствуйте! Хочу заказать сайт.',
        ]);

        $response
            ->assertCreated()
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('contacts', [
            'name' => 'Иван Иванов',
            'email' => 'ivan@test.ru',
        ]);
    }
}
