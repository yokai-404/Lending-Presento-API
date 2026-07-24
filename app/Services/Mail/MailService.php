<?php

namespace App\Services\Mail;

use App\Mail\ContactOwnerMail;
use App\Mail\ContactUserMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendToOwner(Contact $contact): void
    {
        Mail::to(config('mail.admin_address'))
            ->send(new ContactOwnerMail($contact));
    }

    public function sendToUser(Contact $contact): void
    {
        Mail::to($contact->email)
            ->send(new ContactUserMail($contact));
    }
}
