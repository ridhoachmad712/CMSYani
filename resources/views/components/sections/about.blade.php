@props(['settings'])

<section id="tentang-kami" class="bg-cream py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid items-center gap-12 lg:grid-cols-2">
            {{-- Teks --}}
            <div class="reveal">
                <x-section-heading align="left" eyebrow="Mengenal Kami" title="Tentang Kami" />

                <div class="mt-6 space-y-4 text-lg leading-relaxed text-navy/80">
                    @forelse (preg_split('/\R{2,}/', trim((string) $settings->about_text)) as $paragraph)
                        @if (trim($paragraph) !== '')
                            <p>{{ trim($paragraph) }}</p>
                        @endif
                    @empty
                    @endforelse
                </div>
            </div>

            {{-- Kartu kutipan nilai --}}
            <div class="reveal">
                @if ($settings->quote_text)
                    <figure class="relative overflow-hidden rounded-3xl bg-navy px-8 py-10 text-cream shadow-xl">
                        <div class="pointer-events-none absolute -right-6 -top-6 opacity-10">
                            <x-heroicon-s-chat-bubble-bottom-center-text class="h-32 w-32 text-gold" />
                        </div>
                        <span class="font-heading text-6xl leading-none text-gold">&ldquo;</span>
                        <blockquote class="mt-2 font-heading text-xl italic leading-relaxed sm:text-2xl">
                            {{ $settings->quote_text }}
                        </blockquote>
                        <figcaption class="mt-6 flex items-center gap-2 text-sm text-cream/70">
                            <span class="h-px w-8 bg-gold"></span> KAP Muhammad Yani
                        </figcaption>
                    </figure>
                @endif
            </div>
        </div>
    </div>
</section>
