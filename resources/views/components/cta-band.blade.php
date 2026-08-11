@props(['settings'])

@php
    $waNumber = preg_replace('/\D/', '', (string) $settings->whatsapp_number);
@endphp

<section class="bg-navy py-16">
    <div class="mx-auto flex max-w-5xl flex-col items-center gap-6 px-4 text-center sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-cream sm:text-3xl">Punya kebutuhan perpajakan atau hukum pajak?</h2>
        <p class="max-w-2xl text-cream/75">Konsultasikan permasalahan Anda bersama kami. Kami siap membantu memberikan solusi yang tepat dan sesuai ketentuan.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <x-btn :href="route('contact')" variant="primary">Hubungi Kami</x-btn>
            @if ($waNumber)
                <x-btn href="https://wa.me/{{ $waNumber }}" variant="outline-light" target="_blank" rel="noopener">Chat WhatsApp</x-btn>
            @endif
        </div>
    </div>
</section>
