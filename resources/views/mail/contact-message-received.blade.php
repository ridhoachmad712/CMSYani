<x-mail::message>
# Pesan Konsultasi Baru

Ada pesan masuk baru dari form konsultasi website.

**Nama:** {{ $contact->name }}
**Email:** {{ $contact->email }}
**Telepon/WA:** {{ $contact->phone ?: '-' }}
**Subjek:** {{ $contact->subject ?: '-' }}

**Pesan:**
{{ $contact->message }}

<x-mail::button :url="config('app.url') . '/admin/contact-messages'">
Lihat di Panel Admin
</x-mail::button>

Diterima pada {{ $contact->created_at->translatedFormat('d F Y H:i') }}.

Salam,<br>
{{ config('app.name') }}
</x-mail::message>
