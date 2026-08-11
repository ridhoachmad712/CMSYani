<x-layouts.app title="Glosarium Pajak" description="Kamus istilah perpajakan yang sering digunakan.">
    <x-page-hero title="Glosarium Istilah Pajak" subtitle="Kamus singkat istilah perpajakan yang sering digunakan." />

    <section class="bg-cream py-14 sm:py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <form method="GET" class="mb-8 flex gap-2">
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari istilah..."
                       class="w-full rounded-full border border-navy/20 px-4 py-2 text-sm focus:border-gold focus:outline-none focus:ring-1 focus:ring-gold">
                <button type="submit" class="rounded-full bg-gold px-5 py-2 text-sm font-semibold text-navy">Cari</button>
            </form>

            @if ($termGroups->count() > 0)
                @foreach ($termGroups as $letter => $terms)
                    <div class="mb-8">
                        <h2 class="mb-3 flex h-9 w-9 items-center justify-center rounded-full bg-navy font-heading text-lg font-bold text-gold">{{ $letter }}</h2>
                        <dl class="space-y-4">
                            @foreach ($terms as $term)
                                <div class="rounded-xl border border-navy/10 bg-white p-5">
                                    <dt class="font-semibold text-navy">{{ $term->term }}</dt>
                                    <dd class="mt-1 text-sm leading-relaxed text-navy/75">{{ $term->definition }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                @endforeach
            @else
                <x-empty-state message="{{ $search ? 'Tidak ada istilah yang cocok dengan pencarian Anda.' : 'Glosarium sedang disiapkan dan akan segera tersedia.' }}" />
            @endif
        </div>
    </section>
</x-layouts.app>
