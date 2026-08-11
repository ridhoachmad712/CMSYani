@props(['settings'])

<section id="tentang-kami" class="bg-cream py-20 sm:py-24">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold text-navy sm:text-4xl">Tentang Kami</h2>
            <div class="mx-auto mt-3 h-1 w-20 rounded bg-gold"></div>
        </div>

        <div class="mt-10 space-y-5 text-center text-lg leading-relaxed text-navy/80">
            @forelse (preg_split('/\R{2,}/', trim((string) $settings->about_text)) as $paragraph)
                @if (trim($paragraph) !== '')
                    <p>{{ trim($paragraph) }}</p>
                @endif
            @empty
            @endforelse
        </div>

        @if ($settings->quote_text)
            <figure class="mx-auto mt-12 max-w-3xl rounded-2xl border-l-4 border-gold bg-navy px-8 py-8 text-cream">
                <blockquote class="font-heading text-xl italic leading-relaxed sm:text-2xl">
                    &ldquo;{{ $settings->quote_text }}&rdquo;
                </blockquote>
            </figure>
        @endif
    </div>
</section>
