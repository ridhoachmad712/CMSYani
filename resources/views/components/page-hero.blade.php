@props(['title', 'subtitle' => null])

<section class="bg-navy py-14 text-cream sm:py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <nav class="mb-3 text-sm text-cream/60">
            <a href="{{ url('/') }}" class="hover:text-gold">Beranda</a>
            <span class="mx-1">/</span>
            <span class="text-gold">{{ $title }}</span>
        </nav>
        <h1 class="text-3xl font-bold sm:text-4xl">{{ $title }}</h1>
        @if ($subtitle)
            <p class="mt-3 max-w-2xl text-cream/80">{{ $subtitle }}</p>
        @endif
    </div>
</section>
