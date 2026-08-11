@props(['licenses'])

<section id="izin-kualifikasi" class="bg-navy py-20 text-cream sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-section-heading
            class="reveal"
            :light="true"
            eyebrow="Legalitas Terpercaya"
            title="Izin & Kualifikasi"
            subtitle="Legalitas dan kompetensi resmi yang menjadi dasar kepercayaan setiap layanan kami." />

        <div class="reveal mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($licenses as $license)
                <div class="rounded-2xl border border-white/10 bg-navy-secondary/60 p-7 text-center transition duration-300 hover:-translate-y-1 hover:border-gold/40">
                    <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full border-2 border-gold/50 text-gold transition hover:scale-105">
                        @if ($license->icon)
                            <x-dynamic-component :component="$license->icon" class="h-8 w-8" />
                        @else
                            <x-heroicon-o-check-badge class="h-8 w-8" />
                        @endif
                    </div>
                    <h3 class="text-lg font-semibold">{{ $license->title }}</h3>
                    <p class="mt-2 inline-block rounded-full bg-white/5 px-3 py-1 font-mono text-sm text-gold">{{ $license->number }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
