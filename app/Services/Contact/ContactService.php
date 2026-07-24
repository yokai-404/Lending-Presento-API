<?php

namespace App\Services\Contact;

use App\Contracts\AIServiceInterface;
use App\Contracts\ContactRepositoryInterface;
use App\DTO\ContactDTO;
use App\Exceptions\ContactProcessingException;
use App\Models\Contact;
use App\Services\Mail\MailService;

class ContactService
{
    public function __construct(
        private readonly ContactRepositoryInterface $repository,
        private readonly AIServiceInterface $aiService,
        private readonly MailService $mailService,
    ) {}

    public function create(ContactDTO $dto): Contact
    {
        try {
            $aiResult = $this->aiService->analyze($dto);

            $contact = $this->repository->create(
                $dto,
                $aiResult
            );

            $this->mailService->sendToOwner($contact);

            $this->mailService->sendToUser($contact);

            return $contact;

        } catch (\Throwable $e) {

            report($e);

            throw new ContactProcessingException(
                'Не удалось обработать обращение.',
                previous: $e
            );
        }
    }
}
