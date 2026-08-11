<?php

namespace App\Livewire;

use App\Models\NewsletterSubscriber;
use Livewire\Attributes\Validate;
use Livewire\Component;

class NewsletterForm extends Component
{
    #[Validate('required|email|max:150')]
    public string $email = '';

    public bool $subscribed = false;

    public function subscribe(): void
    {
        $validated = $this->validate([
            'email' => 'required|email|max:150',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        NewsletterSubscriber::updateOrCreate(
            ['email' => $validated['email']],
            ['subscribed_at' => now(), 'is_active' => true],
        );

        $this->reset('email');
        $this->subscribed = true;
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
