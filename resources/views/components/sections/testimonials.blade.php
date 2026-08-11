@props(['testimonials'])

@if ($testimonials->isNotEmpty())
    <section
        id="testimoni"
        class="bg-white py-20 sm:py-24"
        x-data="{
            active: 0,
            gap: 24,
            autoplay: null,
            step(dir) {
                const t = this.$refs.track; const c = t.firstElementChild; if (!c) return;
                t.scrollBy({ left: dir * (c.offsetWidth + this.gap), behavior: 'smooth' });
            },
            goTo(i) {
                const t = this.$refs.track; const c = t.children[i]; if (!c) return;
                t.scrollTo({ left: c.offsetLeft - t.offsetLeft, behavior: 'smooth' });
            },
            sync() {
                const t = this.$refs.track; const c = t.firstElementChild; if (!c) return;
                this.active = Math.round(t.scrollLeft / (c.offsetWidth + this.gap));
            },
            advance() {
                const t = this.$refs.track;
                const atEnd = Math.ceil(t.scrollLeft + t.clientWidth) >= t.scrollWidth - 2;
                atEnd ? t.scrollTo({ left: 0, behavior: 'smooth' }) : this.step(1);
            },
            start() { this.autoplay = setInterval(() => this.advance(), 5000); },
            stop() { clearInterval(this.autoplay); },
        }"
        x-init="start()"
        @mouseenter="stop()"
        @mouseleave="start()"
    >
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="reveal flex flex-col items-center gap-4 text-center sm:flex-row sm:items-end sm:justify-between sm:text-left">
                <x-section-heading align="left" eyebrow="Testimoni" title="Apa Kata Klien" />
                <div class="flex gap-2">
                    <button type="button" @click="step(-1)" aria-label="Sebelumnya"
                            class="flex h-11 w-11 items-center justify-center rounded-full border border-navy/15 text-navy transition hover:border-gold hover:text-gold-dark">
                        <x-heroicon-o-chevron-left class="h-5 w-5" />
                    </button>
                    <button type="button" @click="step(1)" aria-label="Berikutnya"
                            class="flex h-11 w-11 items-center justify-center rounded-full border border-navy/15 text-navy transition hover:border-gold hover:text-gold-dark">
                        <x-heroicon-o-chevron-right class="h-5 w-5" />
                    </button>
                </div>
            </div>

            {{-- Track slider --}}
            <div x-ref="track" @scroll.debounce.120ms="sync()"
                 class="no-scrollbar mt-12 flex snap-x snap-mandatory gap-6 overflow-x-auto scroll-smooth pb-2">
                @foreach ($testimonials as $testimonial)
                    <figure class="flex shrink-0 basis-full snap-start flex-col rounded-2xl border border-navy/10 bg-cream p-7 shadow-sm sm:basis-[calc(50%-0.75rem)] lg:basis-[calc(33.333%-1rem)]">
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

            {{-- Titik indikator --}}
            <div class="mt-6 flex justify-center gap-2">
                @foreach ($testimonials as $i => $testimonial)
                    <button type="button" @click="goTo({{ $i }})" aria-label="Ke testimoni {{ $i + 1 }}"
                            class="h-2.5 rounded-full transition-all"
                            :class="active === {{ $i }} ? 'w-6 bg-gold' : 'w-2.5 bg-navy/20 hover:bg-navy/40'"></button>
                @endforeach
            </div>
        </div>
    </section>
@endif
