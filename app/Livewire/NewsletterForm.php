<?php

namespace App\Livewire;

use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Validate;
use Livewire\Component;

class NewsletterForm extends Component
{
    #[Validate('required|email|max:150')]
    public string $email = '';

    public bool $subscribed = false;

    public function subscribe(): void
    {
        $key = 'newsletter:' . request()->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->addError('email', 'Terlalu banyak percobaan. Coba lagi beberapa saat lagi.');

            return;
        }

        $validated = $this->validate([
            'email' => 'required|email|max:150',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        RateLimiter::hit($key, 600);

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
