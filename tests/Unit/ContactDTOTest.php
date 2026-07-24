<?php

namespace Tests\Unit;

use App\DTO\ContactDTO;
use PHPUnit\Framework\TestCase;

class ContactDTOTest extends TestCase
{
    public function test_dto_created_from_array(): void
    {
        $dto = ContactDTO::fromArray([
            'name' => 'Иван',
            'email' => 'ivan@test.ru',
            'phone' => '+79990000000',
            'message' => 'Тестовое сообщение',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Postman',
        ]);

        $this->assertEquals('Иван', $dto->name);
        $this->assertEquals('ivan@test.ru', $dto->email);
        $this->assertEquals('+79990000000', $dto->phone);
        $this->assertEquals('Тестовое сообщение', $dto->message);
        $this->assertEquals('127.0.0.1', $dto->ipAddress);
        $this->assertEquals('Postman', $dto->userAgent);
    }
}
