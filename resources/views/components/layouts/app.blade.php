@props([
    'title' => null,
    'description' => null,
])

@php
    $settings = \App\Models\SiteSetting::cached();
    $pageTitle = $title
        ? $title . ' | KAP Muhammad Yani'
        : 'KAP Muhammad Yani | ' . ($settings->tagline ?: 'Konsultan Pajak & Kuasa Hukum Pajak');
    $pageDescription = $description
        ?: ($settings->hero_subtitle ?: 'Kantor Konsultan Pajak dan Kuasa Hukum Pajak Muhammad Yani, Makassar.');
    $logo = $settings->logo_path
        ? asset('storage/' . $settings->logo_path)
        : asset('images/logo-placeholder.svg');
    $logoHeight = $settings->logo_height ?: 44;
    $waNumber = preg_replace('/\D/', '', (string) $settings->whatsapp_number);
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">
    <meta property="og:image" content="{{ asset('og-image.svg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen antialiased">
    {{-- Header --}}
    <header
        x-data="{ open: false, scrolled: false }"
        x-init="scrolled = window.scrollY > 10; window.addEventListener('scroll', () => scrolled = window.scrollY > 10)"
        class="sticky top-0 z-50 border-b border-navy/10 bg-white transition-shadow duration-300"
        :class="scrolled ? 'shadow-md' : 'shadow-sm'"
    >
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img src="{{ $logo }}" alt="Logo KAP Muhammad Yani" class="w-auto" style="height: {{ $logoHeight }}px">
                <span class="sr-only">KAP Muhammad Yani</span>
            </a>

            {{-- Nav desktop --}}
            @php
                $navLink = fn (bool $active) => 'text-sm font-medium transition hover:text-gold-dark ' . ($active ? 'text-gold-dark' : 'text-navy/80');
            @endphp
            <nav class="hidden items-center gap-7 md:flex">
                <a href="{{ url('/') }}" class="{{ $navLink(request()->routeIs('home')) }}">Beranda</a>
                <a href="{{ route('services.index') }}" class="{{ $navLink(request()->routeIs('services.*')) }}">Layanan</a>
                <a href="{{ route('licenses') }}" class="{{ $navLink(request()->routeIs('licenses')) }}">Izin</a>
                <a href="{{ route('about') }}" class="{{ $navLink(request()->routeIs('about')) }}">Tentang</a>

                {{-- Dropdown Info Pajak --}}
                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                    <button @click="open = !open" class="{{ $navLink(request()->routeIs(['articles.*', 'faq', 'tax-calendar', 'glossary', 'downloads'])) }} flex items-center gap-1">
                        Info Pajak
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                    </button>
                    <div x-show="open" x-cloak x-transition class="absolute left-0 top-full z-50 w-52 rounded-xl border border-navy/10 bg-white py-2 shadow-xl">
                        @foreach ([
                            'Artikel' => route('articles.index'),
                            'FAQ' => route('faq'),
                            'Kalender Pajak' => route('tax-calendar'),
                            'Glosarium' => route('glossary'),
                            'Unduhan' => route('downloads'),
                        ] as $label => $href)
                            <a href="{{ $href }}" class="block px-4 py-2 text-sm text-navy/80 transition hover:bg-cream hover:text-gold-dark">{{ $label }}</a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('contact') }}" class="rounded-full bg-gold px-5 py-2 text-sm font-semibold text-navy shadow transition hover:bg-gold/90">
                    Konsultasi
                </a>
            </nav>

            {{-- Toggle mobile --}}
            <button
                @click="open = !open"
                class="inline-flex items-center justify-center rounded-md p-2 text-navy md:hidden"
                aria-label="Buka menu"
            >
                <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" /></svg>
                <svg x-show="open" x-cloak class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
            </button>
        </div>

        {{-- Nav mobile --}}
        <nav x-show="open" x-cloak x-transition class="border-t border-navy/10 bg-white md:hidden">
            <div class="space-y-1 px-4 py-3">
                @foreach ([
                    'Beranda' => url('/'),
                    'Layanan' => route('services.index'),
                    'Izin & Kualifikasi' => route('licenses'),
                    'Tentang Kami' => route('about'),
                    'Kontak' => route('contact'),
                ] as $label => $href)
                    <a href="{{ $href }}" @click="open = false" class="block rounded px-3 py-2 text-navy/80 transition hover:bg-cream hover:text-gold-dark">{{ $label }}</a>
                @endforeach

                <p class="px-3 pb-1 pt-3 text-xs font-semibold uppercase tracking-wide text-navy/40">Info Pajak</p>
                @foreach ([
                    'Artikel' => route('articles.index'),
                    'FAQ' => route('faq'),
                    'Kalender Pajak' => route('tax-calendar'),
                    'Glosarium' => route('glossary'),
                    'Unduhan' => route('downloads'),
                ] as $label => $href)
                    <a href="{{ $href }}" @click="open = false" class="block rounded px-3 py-2 text-navy/80 transition hover:bg-cream hover:text-gold-dark">{{ $label }}</a>
                @endforeach

                <a href="{{ route('contact') }}" @click="open = false" class="mt-2 block rounded-full bg-gold px-4 py-2 text-center font-semibold text-navy">Konsultasi Sekarang</a>
            </div>
        </nav>
    </header>

    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-navy text-cream/80">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-12 sm:px-6 md:grid-cols-3 lg:px-8">
            <div>
                <img src="{{ $logo }}" alt="Logo KAP Muhammad Yani" class="mb-4 h-12 w-auto">
                <p class="text-sm leading-relaxed">Kantor Konsultan Pajak dan Kuasa Hukum Pajak Muhammad Yani. {{ $settings->tagline }}</p>

                <div class="mt-6">
                    <p class="mb-2 text-sm font-semibold text-gold">Info Pajak Terbaru</p>
                    @livewire('newsletter-form')
                </div>
            </div>
            <div>
                <h3 class="mb-3 text-base font-semibold text-gold">Kontak</h3>
                <ul class="space-y-2 text-sm">
                    @if ($settings->address)
                        <li>{{ $settings->address }}</li>
                    @endif
                    @if ($settings->email)
                        <li><a href="mailto:{{ $settings->email }}" class="hover:text-gold">{{ $settings->email }}</a></li>
                    @endif
                    @if ($settings->phone_primary)
                        <li>{{ $settings->phone_primary }}@if ($settings->phone_secondary) / {{ $settings->phone_secondary }}@endif</li>
                    @endif
                </ul>
            </div>
            <div>
                <h3 class="mb-3 text-base font-semibold text-gold">Tautan</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('services.index') }}" class="hover:text-gold">Layanan</a></li>
                    <li><a href="{{ route('licenses') }}" class="hover:text-gold">Izin & Kualifikasi</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-gold">Tentang Kami</a></li>
                    <li><a href="{{ route('articles.index') }}" class="hover:text-gold">Artikel</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-gold">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-gold">Kontak</a></li>
                    @if ($settings->instagram_url)
                        <li><a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener" class="hover:text-gold">Instagram</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10 py-4">
            <p class="text-center text-xs text-cream/60">&copy; {{ date('Y') }} KAP Muhammad Yani. Seluruh hak cipta dilindungi.</p>
        </div>
    </footer>

    {{-- Floating WhatsApp --}}
    @if ($waNumber)
        <a
            href="https://wa.me/{{ $waNumber }}"
            target="_blank"
            rel="noopener"
            class="fixed bottom-5 right-5 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-[#25D366] text-white shadow-lg transition hover:scale-105"
            aria-label="Hubungi via WhatsApp"
        >
            <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413"/></svg>
        </a>
    @endif

    @livewireScripts
</body>
</html>
