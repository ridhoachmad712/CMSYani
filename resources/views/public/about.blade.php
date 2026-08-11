<x-layouts.app title="Tentang Kami" description="Profil Kantor Konsultan Pajak dan Kuasa Hukum Pajak Muhammad Yani.">
    <x-page-hero title="Tentang Kami" subtitle="Mengenal Kantor Konsultan Pajak dan Kuasa Hukum Pajak Muhammad Yani." />

    @php
        $photo = $settings->profile_photo ? asset('storage/' . $settings->profile_photo) : null;
    @endphp

    {{-- Profil --}}
    <section class="bg-cream py-16 sm:py-20">
        <div class="mx-auto grid max-w-6xl items-center gap-12 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div>
                <p class="text-sm font-semibold uppercase tracking-widest text-gold-dark">Konsultan Pajak &middot; Kuasa Hukum Pajak</p>
                <h2 class="mt-2 font-heading text-3xl font-bold text-navy sm:text-4xl">Muhammad Yani</h2>
                <p class="mt-1 text-navy/60">S.E., Ak., M.Ak., M.H., CTR., CPAFS., BKP.</p>

                <div class="mt-6 space-y-4 text-lg leading-relaxed text-navy/80">
                    @foreach (preg_split('/\R{2,}/', trim((string) $settings->about_text)) as $paragraph)
                        @if (trim($paragraph) !== '')
                            <p>{{ trim($paragraph) }}</p>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="relative mx-auto w-full max-w-sm">
                <div class="absolute -inset-3 rounded-3xl border border-gold/30"></div>
                @if ($photo)
                    <img src="{{ $photo }}" alt="Muhammad Yani" class="relative aspect-[3/4] w-full rounded-2xl object-cover shadow-xl">
                @else
                    <div class="relative flex aspect-[3/4] w-full flex-col items-center justify-center rounded-2xl bg-navy shadow-xl">
                        <span class="flex h-24 w-24 items-center justify-center rounded-full border-2 border-gold/40 text-gold">
                            <x-heroicon-o-user class="h-12 w-12" />
                        </span>
                        <p class="mt-5 font-heading text-xl text-cream">Muhammad Yani</p>
                        <p class="mt-1 text-xs uppercase tracking-widest text-gold/80">Konsultan Pajak</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Kutipan nilai --}}
    @if ($settings->quote_text)
        <section class="bg-navy py-14">
            <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
                <span class="font-heading text-5xl leading-none text-gold">&ldquo;</span>
                <blockquote class="mt-2 font-heading text-2xl italic leading-relaxed text-cream sm:text-3xl">
                    {{ $settings->quote_text }}
                </blockquote>
            </div>
        </section>
    @endif

    {{-- Nilai inti --}}
    <x-sections.values />

    {{-- Kredensial ringkas --}}
    <section class="bg-cream py-16">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-navy/10 bg-white p-8 text-center shadow-sm">
                <h2 class="text-xl font-semibold text-navy">Berizin & Terkualifikasi Resmi</h2>
                <p class="mx-auto mt-2 max-w-2xl text-navy/70">Layanan kami didukung izin praktik resmi di bidang konsultan pajak, kuasa hukum pajak, serta kepabeanan dan cukai.</p>
                <div class="mt-5">
                    <x-btn :href="route('licenses')" variant="outline-dark">Lihat Izin & Kualifikasi</x-btn>
                </div>
            </div>
        </div>
    </section>

    <x-cta-band :settings="$settings" />
</x-layouts.app>
