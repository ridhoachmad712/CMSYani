<x-layouts.app title="Layanan Kami" description="Layanan profesional perpajakan dan hukum pajak dari KAP Muhammad Yani.">
    <x-page-hero title="Layanan Kami" subtitle="Solusi menyeluruh di bidang perpajakan dan hukum pajak untuk perusahaan, individu, maupun instansi." />

    <section class="bg-cream py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $service)
                    <a href="{{ route('services.show', $service->slug) }}"
                       class="group relative flex flex-col overflow-hidden rounded-2xl border border-navy/10 bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-gold/50 hover:shadow-lg">
                        <span class="absolute left-0 top-0 h-full w-1 bg-gold opacity-0 transition group-hover:opacity-100"></span>
                        <div class="mb-5 flex items-center justify-between">
                            <div class="flex h-14 w-14 items-center justify-center rounded-full border border-gold/40 bg-gold/10 text-gold transition group-hover:bg-gold group-hover:text-navy">
                                @if ($service->icon)
                                    <x-dynamic-component :component="$service->icon" class="h-7 w-7" />
                                @else
                                    <x-heroicon-o-briefcase class="h-7 w-7" />
                                @endif
                            </div>
                            <span class="font-heading text-3xl font-bold text-navy/10">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <h2 class="text-xl font-semibold text-navy">{{ $service->title }}</h2>
                        <p class="mt-3 flex-1 text-sm leading-relaxed text-navy/70">{{ $service->description }}</p>
                        <span class="mt-4 inline-flex items-center gap-1 text-sm font-medium text-gold-dark">
                            Selengkapnya <x-heroicon-o-arrow-right class="h-4 w-4 transition group-hover:translate-x-1" />
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Nilai inti --}}
    <x-sections.values />

    {{-- CTA --}}
    <x-cta-band :settings="$settings" />
</x-layouts.app>
