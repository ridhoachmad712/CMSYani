@props(['licenses'])

<section id="izin-kualifikasi" class="bg-navy py-20 text-cream sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="reveal mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold sm:text-4xl">Izin & Kualifikasi</h2>
            <div class="mx-auto mt-3 h-1 w-20 rounded bg-gold"></div>
            <p class="mt-4 text-cream/75">
                Legalitas dan kompetensi resmi yang menjadi dasar kepercayaan setiap layanan kami.
            </p>
        </div>

        <div class="reveal mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($licenses as $license)
                <div class="rounded-2xl border border-white/10 bg-navy-secondary/60 p-7 text-center">
                    <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full border-2 border-gold/50 text-gold">
                        @if ($license->icon)
                            <x-dynamic-component :component="$license->icon" class="h-8 w-8" />
                        @else
                            <x-heroicon-o-check-badge class="h-8 w-8" />
                        @endif
                    </div>
                    <h3 class="text-lg font-semibold">{{ $license->title }}</h3>
                    <p class="mt-2 font-mono text-sm text-gold">{{ $license->number }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
