<x-layouts.app title="FAQ Pajak" description="Pertanyaan yang sering diajukan seputar pajak dan layanan KAP Muhammad Yani.">
    <x-page-hero title="FAQ Pajak" subtitle="Pertanyaan yang sering diajukan seputar pajak dan layanan kami." />

    <section class="bg-cream py-14 sm:py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            @if ($faqGroups->count() > 0)
                @foreach ($faqGroups as $category => $faqs)
                    <div class="mb-8">
                        <h2 class="mb-4 text-xl font-semibold text-navy">{{ $category }}</h2>
                        <div class="space-y-3">
                            @foreach ($faqs as $faq)
                                <div x-data="{ open: false }" class="overflow-hidden rounded-xl border border-navy/10 bg-white">
                                    <button type="button" @click="open = !open" class="flex w-full items-center justify-between gap-4 px-5 py-4 text-left">
                                        <span class="font-medium text-navy">{{ $faq->question }}</span>
                                        <x-heroicon-o-chevron-down class="h-5 w-5 flex-none text-gold transition-transform duration-200" x-bind:class="open ? 'rotate-180' : ''" />
                                    </button>
                                    <div x-show="open" x-cloak x-transition.opacity class="px-5 pb-5 text-sm leading-relaxed text-navy/75">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <x-empty-state message="Daftar FAQ sedang disiapkan dan akan segera tersedia." />
            @endif
        </div>
    </section>
</x-layouts.app>
