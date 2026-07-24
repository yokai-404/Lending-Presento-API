<?php

namespace App\Contracts;

use App\DTO\ContactDTO;
use App\Models\Contact;
use Illuminate\Support\Collection;

interface ContactRepositoryInterface
{
    public function create(ContactDTO $dto, array $aiData): Contact;

    public function count(): int;

    public function latest(int $limit = 10): Collection;
}
