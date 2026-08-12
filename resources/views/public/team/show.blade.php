<x-layouts.app :title="$member->name" :description="$member->role">
    <x-page-hero :title="$member->name" :subtitle="$member->role" />

    <section class="bg-cream py-16 sm:py-20">
        <div class="mx-auto grid max-w-6xl gap-10 px-4 sm:px-6 lg:grid-cols-3 lg:px-8">
            {{-- Foto & kontak --}}
            <aside class="lg:col-span-1">
                <div class="overflow-hidden rounded-2xl border border-navy/10 bg-white shadow-sm">
                    @if ($member->photo)
                        <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}"
                             class="aspect-[4/5] w-full object-cover object-top">
                    @else
                        <div class="flex aspect-[4/5] w-full items-center justify-center bg-navy/5 text-gold-dark/50">
                            <x-heroicon-o-user class="h-24 w-24" />
                        </div>
                    @endif
                    <div class="p-6">
                        <span class="text-xs font-semibold uppercase tracking-wider text-gold-dark">{{ $member->role }}</span>
                        <h2 class="mt-1 text-lg font-bold text-navy">{{ $member->name }}</h2>

                        @if ($member->email || $member->linkedin_url)
                            <div class="mt-4 space-y-2 border-t border-navy/10 pt-4 text-sm">
                                @if ($member->email)
                                    <a href="mailto:{{ $member->email }}" class="flex items-center gap-2 text-navy/75 transition hover:text-gold-dark">
                                        <x-heroicon-o-envelope class="h-4 w-4 text-gold-dark" /> {{ $member->email }}
                                    </a>
                                @endif
                                @if ($member->linkedin_url)
                                    <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener" class="flex items-center gap-2 text-navy/75 transition hover:text-gold-dark">
                                        <svg class="h-4 w-4 fill-current text-gold-dark" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                                        Profil LinkedIn
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <a href="{{ route('about') }}#tim-kami" class="mt-4 inline-block text-sm font-medium text-gold-dark hover:underline">&larr; Kembali ke Tim Kami</a>
            </aside>

            {{-- Profil lengkap --}}
            <div class="lg:col-span-2">
                <div class="rounded-2xl border border-navy/10 bg-white p-8 shadow-sm">
                    @if ($member->bio)
                        <p class="text-lg leading-relaxed text-navy/80">{{ $member->bio }}</p>
                    @endif

                    @if ($member->detail)
                        <div class="prose prose-navy mt-6 max-w-none text-navy/85">
                            {!! $member->detail !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Anggota lain --}}
        @if ($others->isNotEmpty())
            <div class="mx-auto mt-14 max-w-6xl px-4 sm:px-6 lg:px-8">
                <h2 class="mb-6 text-2xl font-bold text-navy">Anggota Tim Lainnya</h2>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($others as $other)
                        <a href="{{ route('team.show', $other->slug) }}"
                           class="flex items-center gap-4 rounded-2xl border border-navy/10 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-gold/50 hover:shadow-md">
                            @if ($other->photo)
                                <img src="{{ asset('storage/' . $other->photo) }}" alt="{{ $other->name }}" class="h-14 w-14 flex-none rounded-full object-cover object-top">
                            @else
                                <span class="flex h-14 w-14 flex-none items-center justify-center rounded-full bg-navy/5 text-gold-dark/60">
                                    <x-heroicon-o-user class="h-7 w-7" />
                                </span>
                            @endif
                            <div>
                                <p class="font-semibold text-navy">{{ \Illuminate\Support\Str::before($other->name, ',') }}</p>
                                <p class="text-xs text-navy/60">{{ $other->role }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>

    <x-cta-band :settings="$settings" />
</x-layouts.app>
