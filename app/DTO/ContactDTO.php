<?php

namespace App\DTO;

readonly class ContactDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public string $message,
        public string $ipAddress,
        public string $userAgent,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'],
            message: $data['message'],
            ipAddress: $data['ip_address'],
            userAgent: $data['user_agent'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
            'ip_address' => $this->ipAddress,
            'user_agent' => $this->userAgent,
        ];
    }
}
