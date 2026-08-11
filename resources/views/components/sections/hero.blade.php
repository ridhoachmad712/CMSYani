@props(['settings'])

@php
    $waNumber = preg_replace('/\D/', '', (string) $settings->whatsapp_number);
    $photo = $settings->profile_photo ? asset('storage/' . $settings->profile_photo) : null;
@endphp

<section id="beranda" class="relative overflow-hidden bg-navy text-cream">
    {{-- Aksen dekoratif --}}
    <div class="pointer-events-none absolute inset-0 opacity-20"
         style="background-image: radial-gradient(circle at 15% 15%, #C9A24B 0, transparent 38%), radial-gradient(circle at 85% 10%, #132A4F 0, transparent 45%);"></div>

    <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-4 py-20 sm:px-6 sm:py-24 lg:grid-cols-2 lg:px-8">
        {{-- Kolom teks --}}
        <div class="max-w-2xl">
            <span class="mb-4 inline-flex items-center gap-2 rounded-full border border-gold/40 bg-gold/10 px-4 py-1.5 text-sm font-medium text-gold">
                <x-heroicon-s-check-badge class="h-4 w-4" />
                Terdaftar &amp; Berizin Resmi
            </span>

            <p class="mb-2 text-sm font-medium uppercase tracking-widest text-cream/60">Konsultan Pajak &middot; Kuasa Hukum Pajak</p>
            <h1 class="text-4xl font-bold leading-tight sm:text-5xl lg:text-6xl">Muhammad Yani</h1>
            <p class="mt-2 text-sm font-medium text-cream/70">S.E., Ak., M.Ak., M.H., CTR., CPAFS., BKP.</p>

            <p class="mt-6 font-heading text-2xl text-gold sm:text-3xl">
                {{ $settings->tagline ?: 'Solusi Tepat Kepatuhan Hemat' }}
            </p>
            <p class="mt-4 max-w-xl text-base leading-relaxed text-cream/85 sm:text-lg">
                {{ $settings->hero_subtitle ?: 'Solusi Profesional untuk Kepatuhan Pajak dan Perlindungan Hukum Bisnis Anda' }}
            </p>

            <div class="mt-8 flex flex-wrap gap-4">
                <x-btn :href="route('contact')" variant="primary">Konsultasi Sekarang</x-btn>
                @if ($waNumber)
                    <x-btn href="https://wa.me/{{ $waNumber }}" variant="outline-light" target="_blank" rel="noopener">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                        Chat WhatsApp
                    </x-btn>
                @endif
            </div>
        </div>

        {{-- Kolom visual: foto profil, dengan placeholder elegan bila belum diupload --}}
        <div class="relative">
            <div class="relative mx-auto max-w-sm">
                <div class="absolute -inset-3 rounded-3xl border border-gold/30"></div>
                @if ($photo)
                    <img src="{{ $photo }}" alt="Muhammad Yani" class="relative aspect-[3/4] w-full rounded-2xl object-cover shadow-2xl">
                @else
                    <div class="relative flex aspect-[3/4] w-full flex-col items-center justify-center rounded-2xl bg-navy-secondary/60 shadow-2xl">
                        <span class="flex h-24 w-24 items-center justify-center rounded-full border-2 border-gold/40 text-gold">
                            <x-heroicon-o-user class="h-12 w-12" />
                        </span>
                        <p class="mt-5 font-heading text-xl text-cream">Muhammad Yani</p>
                        <p class="mt-1 text-xs uppercase tracking-widest text-gold/80">Konsultan Pajak</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
