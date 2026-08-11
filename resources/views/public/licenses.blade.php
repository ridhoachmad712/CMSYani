<x-layouts.app title="Izin & Kualifikasi" description="Legalitas dan kualifikasi resmi KAP Muhammad Yani.">
    <x-page-hero title="Izin & Kualifikasi" subtitle="Legalitas dan kompetensi resmi yang menjadi dasar kepercayaan setiap layanan kami." />

    <section class="bg-cream py-16 sm:py-20">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <p class="mx-auto mb-12 max-w-3xl text-center text-lg leading-relaxed text-navy/75">
                Sebagai Konsultan Pajak dan Kuasa Hukum Pajak, kami menjalankan layanan berdasarkan izin praktik resmi. Legalitas ini memastikan setiap penanganan dilakukan secara profesional, independen, dan sesuai ketentuan yang berlaku.
            </p>

            <div class="space-y-5">
                @foreach ($licenses as $license)
                    <div class="flex items-start gap-5 rounded-2xl border border-navy/10 bg-white p-6 shadow-sm transition hover:border-gold/40 hover:shadow-md">
                        <span class="flex h-16 w-16 flex-none items-center justify-center rounded-full border-2 border-gold/50 text-gold">
                            @if ($license->icon)
                                <x-dynamic-component :component="$license->icon" class="h-8 w-8" />
                            @else
                                <x-heroicon-o-check-badge class="h-8 w-8" />
                            @endif
                        </span>
                        <div class="flex-1">
                            <h2 class="text-lg font-semibold text-navy">{{ $license->title }}</h2>
                            <p class="mt-1 text-sm text-navy/60">Nomor Izin</p>
                            <p class="font-mono text-base text-gold-dark">{{ $license->number }}</p>
                        </div>
                        <x-heroicon-s-check-badge class="hidden h-7 w-7 flex-none text-gold sm:block" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-band :settings="$settings" />
</x-layouts.app>
