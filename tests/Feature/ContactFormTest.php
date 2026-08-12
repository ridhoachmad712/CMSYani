<?php

namespace Tests\Feature;

use App\Livewire\ContactForm;
use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        SiteSetting::updateOrCreate(['id' => 1], ['email' => 'admin@example.test']);
    }

    public function test_submit_valid_menyimpan_pesan_dan_mengirim_email(): void
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set('name', 'Budi Santoso')
            ->set('email', 'budi@example.com')
            ->set('phone', '08123456789')
            ->set('subject', 'Konsultasi Pajak')
            ->set('message', 'Saya ingin berkonsultasi mengenai SPT tahunan perusahaan.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('sent', true);

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'budi@example.com',
            'subject' => 'Konsultasi Pajak',
            'is_read' => false,
        ]);

        Mail::assertSent(ContactMessageReceived::class);
    }

    public function test_validasi_gagal_untuk_input_kosong(): void
    {
        Livewire::test(ContactForm::class)
            ->set('name', '')
            ->set('email', 'bukan-email')
            ->set('message', 'pendek')
            ->call('submit')
            ->assertHasErrors(['name', 'email', 'message']);

        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_honeypot_memblokir_bot_tanpa_menyimpan(): void
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set('name', 'Bot Spam')
            ->set('email', 'bot@spam.com')
            ->set('message', 'Ini pesan dari bot otomatis yang panjang.')
            ->set('website', 'http://spam.example') // honeypot terisi
            ->call('submit')
            ->assertSet('sent', true);

        $this->assertDatabaseCount('contact_messages', 0);
        Mail::assertNothingSent();
    }

    public function test_rate_limit_memblokir_setelah_5_pengiriman(): void
    {
        Mail::fake();

        for ($i = 1; $i <= 5; $i++) {
            Livewire::test(ContactForm::class)
                ->set('name', "Pengirim {$i}")
                ->set('email', "orang{$i}@example.com")
                ->set('message', 'Pesan konsultasi yang cukup panjang untuk lolos validasi.')
                ->call('submit')
                ->assertSet('sent', true);
        }

        // Pengiriman ke-6 harus terblokir rate limit.
        Livewire::test(ContactForm::class)
            ->set('name', 'Pengirim 6')
            ->set('email', 'orang6@example.com')
            ->set('message', 'Pesan konsultasi yang cukup panjang untuk lolos validasi.')
            ->call('submit')
            ->assertHasErrors('message');

        $this->assertDatabaseCount('contact_messages', 5);
    }
}
