@props(['settings'])

@php
    $waNumber = preg_replace('/\D/', '', (string) $settings->whatsapp_number);
    $photo = $settings->profile_photo ? asset('storage/' . $settings->profile_photo) : null;
    $heroColor = $settings->hero_bg_color ?: '#0B1E3D';
    $heroImage = $settings->hero_bg_image ? asset('storage/' . $settings->hero_bg_image) : null;

    // Ukuran foto (px) & posisi, diatur dari panel admin.
    $photoMaxPx = (int) ($settings->profile_photo_size ?: 0);
    // Fallback ukuran otomatis bila px tidak diisi.
    $photoSizeClass = $photoMaxPx > 0 ? '' : 'max-h-[52vh] lg:max-h-[80vh]';
    $photoStyle = $photoMaxPx > 0 ? "max-height: {$photoMaxPx}px" : '';
    $photoPosClass = match ($settings->profile_photo_position) {
        'kiri' => 'lg:justify-start',
        'tengah' => 'lg:justify-center',
        default => 'lg:justify-end', // kanan
    };
@endphp

<section id="beranda" class="relative overflow-hidden text-cream" style="background-color: {{ $heroColor }};">
    {{-- Latar --}}
    @if ($heroImage)
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $heroImage }}');"></div>
        <div class="absolute inset-0" style="background: linear-gradient(90deg, {{ $heroColor }} 0%, {{ $heroColor }}e6 45%, {{ $heroColor }}80 100%);"></div>
    @else
        <div class="pointer-events-none absolute inset-0 opacity-20"
             style="background-image: radial-gradient(circle at 15% 15%, #C9A24B 0, transparent 38%), radial-gradient(circle at 85% 10%, #132A4F 0, transparent 45%);"></div>
    @endif

    <div class="relative mx-auto grid max-w-7xl items-end gap-8 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
        {{-- Kolom teks --}}
        <div class="max-w-2xl py-16 sm:py-20 lg:py-28">
            <span class="mb-4 inline-flex items-center gap-2 rounded-full border border-gold/40 bg-gold/10 px-4 py-1.5 text-sm font-medium text-gold">
                <x-heroicon-s-check-badge class="h-4 w-4" />
                {{ site_text('hero_badge') }}
            </span>

            <p class="mb-2 text-sm font-medium uppercase tracking-widest text-cream/60">{{ site_text('hero_eyebrow') }}</p>
            <h1 class="text-4xl font-bold leading-tight sm:text-5xl lg:text-6xl">{{ site_text('hero_name') }}</h1>
            <p class="mt-2 text-sm font-medium text-cream/70">{{ site_text('hero_gelar') }}</p>

            <p class="mt-6 font-heading text-2xl text-gold sm:text-3xl">
                {{ $settings->tagline ?: 'Solusi Tepat Kepatuhan Hemat' }}
            </p>
            <p class="mt-4 max-w-xl text-base leading-relaxed text-cream/85 sm:text-lg">
                {{ $settings->hero_subtitle ?: 'Solusi Profesional untuk Kepatuhan Pajak dan Perlindungan Hukum Bisnis Anda' }}
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:gap-4">
                <x-btn :href="route('contact')" variant="primary" class="w-full sm:w-auto">{{ site_text('hero_cta_primary') }}</x-btn>
                @if ($waNumber)
                    <x-btn href="https://wa.me/{{ $waNumber }}" variant="outline-light" target="_blank" rel="noopener" class="w-full sm:w-auto">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                        Chat WhatsApp
                    </x-btn>
                @endif
            </div>
        </div>

        {{-- Kolom foto: tanpa frame, penuh sampai tepi bawah hero --}}
        <div class="flex justify-center self-end lg:h-full lg:items-end {{ $photoPosClass }}">
            @if ($photo)
                <img src="{{ $photo }}" alt="Muhammad Yani" @if ($photoStyle) style="{{ $photoStyle }}" @endif
                     class="w-auto {{ $photoSizeClass }} max-w-full object-contain object-bottom drop-shadow-2xl">
            @else
                <div class="flex h-64 w-48 items-end justify-center text-gold/40 lg:h-[28rem]">
                    <x-heroicon-o-user class="h-40 w-40" />
                </div>
            @endif
        </div>
    </div>
</section>
