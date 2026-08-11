@props(['services'])

<section id="layanan" class="bg-cream py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="reveal mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold text-navy sm:text-4xl">Layanan Kami</h2>
            <div class="mx-auto mt-3 h-1 w-20 rounded bg-gold"></div>
            <p class="mt-4 text-navy/70">
                Layanan profesional di bidang perpajakan dan hukum pajak untuk perusahaan, individu, maupun instansi.
            </p>
        </div>

        <div class="reveal mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($services as $service)
                <div class="group rounded-2xl border border-navy/10 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:border-gold/50 hover:shadow-md">
                    <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-full border border-gold/40 bg-gold/10 text-gold transition group-hover:bg-gold group-hover:text-navy">
                        @if ($service->icon)
                            <x-dynamic-component :component="$service->icon" class="h-7 w-7" />
                        @else
                            <x-heroicon-o-briefcase class="h-7 w-7" />
                        @endif
                    </div>
                    <h3 class="text-xl font-semibold text-navy">{{ $service->title }}</h3>
                    <p class="mt-3 text-sm leading-relaxed text-navy/70">{{ $service->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
