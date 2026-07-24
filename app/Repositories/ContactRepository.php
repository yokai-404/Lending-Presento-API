<?php

namespace App\Repositories;

use App\Contracts\ContactRepositoryInterface;
use App\DTO\ContactDTO;
use App\Models\Contact;
use Illuminate\Support\Collection;

class ContactRepository implements ContactRepositoryInterface
{
    public function create(ContactDTO $dto, array $aiData): Contact
    {
        return Contact::create([
            ...$dto->toArray(),

            'sentiment' => $aiData['sentiment'] ?? 'neutral',
            'category' => $aiData['category'] ?? 'other',
            'ai_reply' => $aiData['ai_reply'] ?? null,

            'status' => 'new',
        ]);
    }

    public function count(): int
    {
        return Contact::query()->count();
    }

    public function latest(int $limit = 10): Collection
    {
        return Contact::query()
            ->latest()
            ->limit($limit)
            ->get();
    }
}
