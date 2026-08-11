@props(['testimonials'])

@if ($testimonials->isNotEmpty())
    <section id="testimoni" class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="reveal mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold text-navy sm:text-4xl">Apa Kata Klien</h2>
                <div class="mx-auto mt-3 h-1 w-20 rounded bg-gold"></div>
            </div>

            <div class="reveal mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($testimonials as $testimonial)
                    <figure class="flex flex-col rounded-2xl border border-navy/10 bg-cream p-7 shadow-sm">
                        @if ($testimonial->rating)
                            <div class="mb-3 flex gap-0.5 text-gold">
                                @for ($i = 0; $i < $testimonial->rating; $i++)
                                    <x-heroicon-s-star class="h-5 w-5" />
                                @endfor
                            </div>
                        @endif
                        <blockquote class="flex-1 text-navy/80">&ldquo;{{ $testimonial->content }}&rdquo;</blockquote>
                        <figcaption class="mt-5 flex items-center gap-3">
                            @if ($testimonial->photo)
                                <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->client_name }}" class="h-11 w-11 rounded-full object-cover">
                            @else
                                <span class="flex h-11 w-11 items-center justify-center rounded-full bg-navy text-gold">
                                    <x-heroicon-o-user class="h-6 w-6" />
                                </span>
                            @endif
                            <div>
                                <p class="font-semibold text-navy">{{ $testimonial->client_name }}</p>
                                @if ($testimonial->client_role)
                                    <p class="text-sm text-navy/60">{{ $testimonial->client_role }}</p>
                                @endif
                            </div>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>
@endif
