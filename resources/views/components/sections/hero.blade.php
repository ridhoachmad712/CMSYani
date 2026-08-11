@props(['settings'])

@php
    $waNumber = preg_replace('/\D/', '', (string) $settings->whatsapp_number);
@endphp

<section id="beranda" class="relative overflow-hidden bg-navy text-cream">
    {{-- Aksen dekoratif --}}
    <div class="pointer-events-none absolute inset-0 opacity-20"
         style="background-image: radial-gradient(circle at 20% 20%, #C9A24B 0, transparent 40%), radial-gradient(circle at 80% 0%, #132A4F 0, transparent 45%);"></div>

    <div class="relative mx-auto max-w-7xl px-4 py-20 sm:px-6 sm:py-28 lg:px-8">
        <div class="max-w-3xl">
            <p class="mb-3 inline-block rounded-full border border-gold/40 px-4 py-1 text-sm font-medium tracking-wide text-gold">
                Konsultan Pajak &middot; Kuasa Hukum Pajak
            </p>
            <h1 class="text-4xl font-bold leading-tight sm:text-5xl lg:text-6xl">
                Muhammad Yani
            </h1>
            <p class="mt-2 text-sm font-medium text-cream/70 sm:text-base">
                S.E., Ak., M.Ak., M.H., CTR., CPAFS., BKP.
            </p>

            <p class="mt-6 font-heading text-2xl text-gold sm:text-3xl">
                {{ $settings->tagline ?: 'Solusi Tepat Kepatuhan Hemat' }}
            </p>
            <p class="mt-4 max-w-2xl text-base leading-relaxed text-cream/85 sm:text-lg">
                {{ $settings->hero_subtitle ?: 'Solusi Profesional untuk Kepatuhan Pajak dan Perlindungan Hukum Bisnis Anda' }}
            </p>

            <div class="mt-8 flex flex-wrap gap-4">
                <a href="#kontak" class="rounded-full bg-gold px-7 py-3 font-semibold text-navy shadow-lg transition hover:bg-gold/90">
                    Konsultasi Sekarang
                </a>
                @if ($waNumber)
                    <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener"
                       class="rounded-full border border-cream/30 px-7 py-3 font-semibold text-cream transition hover:border-gold hover:text-gold">
                        Chat WhatsApp
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
