@props(['licenses'])

<section id="izin-kualifikasi" class="bg-white py-14 sm:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-section-heading
            class="reveal"
            eyebrow="Legalitas Terpercaya"
            title="Izin & Kualifikasi"
            subtitle="Legalitas dan kompetensi resmi yang menjadi dasar kepercayaan setiap layanan kami." />

        <div class="reveal mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($licenses as $license)
                <div class="flex items-center gap-4 rounded-2xl border border-navy/10 bg-cream/60 p-6 transition duration-300 hover:-translate-y-1 hover:border-gold/50 hover:shadow-md">
                    <span class="flex h-14 w-14 flex-none items-center justify-center rounded-full border-2 border-gold/50 text-gold transition hover:scale-105">
                        @if ($license->icon)
                            <x-dynamic-component :component="$license->icon" class="h-7 w-7" />
                        @else
                            <x-heroicon-o-check-badge class="h-7 w-7" />
                        @endif
                    </span>
                    <div>
                        <h3 class="font-semibold text-navy">{{ $license->title }}</h3>
                        <p class="mt-1 font-mono text-sm text-gold-dark">{{ $license->number }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
