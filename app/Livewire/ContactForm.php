<?php

namespace App\Livewire;

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactForm extends Component
{
    #[Validate('required|string|min:3|max:100')]
    public string $name = '';

    #[Validate('required|email|max:150')]
    public string $email = '';

    #[Validate('nullable|string|max:30')]
    public string $phone = '';

    #[Validate('nullable|string|max:150')]
    public string $subject = '';

    #[Validate('required|string|min:10|max:3000')]
    public string $message = '';

    /**
     * Honeypot: field tersembunyi yang harus tetap kosong.
     * Bot biasanya mengisi semua field, sehingga isian di sini menandakan spam.
     */
    public string $website = '';

    public bool $sent = false;

    protected function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.min' => 'Nama minimal 3 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min' => 'Pesan minimal 10 karakter.',
        ];
    }

    public function submit(): void
    {
        // Rate limit sederhana per sesi + honeypot.
        if (filled($this->website)) {
            // Diam-diam anggap sukses agar bot tidak tahu terdeteksi.
            $this->reset(['name', 'email', 'phone', 'subject', 'message', 'website']);
            $this->sent = true;

            return;
        }

        $validated = $this->validate();

        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $this->phone ?: null,
            'subject' => $this->subject ?: null,
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        // Notifikasi email ke admin (best-effort: jangan gagalkan submit bila mail error).
        $adminEmail = SiteSetting::cached()->email;
        if ($adminEmail) {
            try {
                Mail::to($adminEmail)->send(new ContactMessageReceived($contactMessage));
            } catch (\Throwable $e) {
                report($e);
            }
        }

        $this->reset(['name', 'email', 'phone', 'subject', 'message', 'website']);
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
