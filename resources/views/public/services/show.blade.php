<x-layouts.app :title="$service->title" :description="$service->description">
    <x-page-hero :title="$service->title" subtitle="Layanan KAP Muhammad Yani" />

    <section class="bg-cream py-16 sm:py-20">
        <div class="mx-auto grid max-w-6xl gap-10 px-4 sm:px-6 lg:grid-cols-3 lg:px-8">
            {{-- Konten layanan --}}
            <div class="lg:col-span-2">
                <div class="rounded-2xl border border-navy/10 bg-white p-8 shadow-sm">
                    <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full border border-gold/40 bg-gold/10 text-gold">
                        @if ($service->icon)
                            <x-dynamic-component :component="$service->icon" class="h-8 w-8" />
                        @else
                            <x-heroicon-o-briefcase class="h-8 w-8" />
                        @endif
                    </div>
                    <h2 class="text-2xl font-bold text-navy">{{ $service->title }}</h2>
                    <p class="mt-4 text-lg leading-relaxed text-navy/80">{{ $service->description }}</p>

                    <div class="mt-8 rounded-xl bg-navy/5 p-6">
                        <p class="font-semibold text-navy">Butuh bantuan untuk {{ $service->title }}?</p>
                        <p class="mt-1 text-sm text-navy/70">Tim kami siap mendampingi Anda sesuai ketentuan yang berlaku.</p>
                        <div class="mt-4">
                            <x-btn :href="route('contact')" variant="navy">Konsultasi Sekarang</x-btn>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Layanan lainnya --}}
            <aside>
                <div class="rounded-2xl border border-navy/10 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 font-semibold text-navy">Layanan Lainnya</h3>
                    <ul class="space-y-1">
                        @foreach ($others as $other)
                            <li>
                                <a href="{{ route('services.show', $other->slug) }}"
                                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-navy/75 transition hover:bg-cream hover:text-gold-dark">
                                    @if ($other->icon)
                                        <x-dynamic-component :component="$other->icon" class="h-5 w-5 flex-none text-gold" />
                                    @endif
                                    {{ $other->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('services.index') }}" class="mt-4 inline-block text-sm font-medium text-gold-dark hover:underline">&larr; Semua layanan</a>
                </div>
            </aside>
        </div>
    </section>

    <x-cta-band :settings="$settings" />
</x-layouts.app>
