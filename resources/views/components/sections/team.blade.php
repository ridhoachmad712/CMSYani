@props(['members' => [], 'dark' => false])

@if ($members->isNotEmpty())
    <section id="tim-kami"
             class="{{ $dark ? 'bg-navy' : 'border-t border-navy/5 bg-white' }} py-14 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="reveal mx-auto flex max-w-2xl flex-col items-center text-center">
                <span class="mb-2 text-sm font-semibold uppercase tracking-widest {{ $dark ? 'text-gold' : 'text-gold-dark' }}">Profesional &amp; Berpengalaman</span>
                <h2 class="text-3xl font-bold sm:text-4xl {{ $dark ? 'text-cream' : 'text-navy' }}">Tim Konsultan &amp; Rekan</h2>
                <div class="mx-auto mt-3 h-1 w-20 rounded bg-gold"></div>
                <p class="mt-4 {{ $dark ? 'text-cream/75' : 'text-navy/70' }}">
                    KAP Muhammad Yani &amp; Rekan didukung oleh para konsultan dan ahli hukum perpajakan yang siap mendampingi kepatuhan serta solusi hukum bisnis Anda.
                </p>
            </div>

            <div class="reveal mt-14 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($members as $member)
                    @php
                        $photoUrl = $member->photo ? asset('storage/' . $member->photo) : null;
                        $profileUrl = filled($member->slug) ? route('team.show', $member->slug) : null;
                    @endphp
                    <div class="group relative flex flex-col overflow-hidden rounded-2xl border {{ $dark ? 'border-white/10 bg-white' : 'border-navy/10 bg-cream' }} p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-gold/50 hover:shadow-xl">
                        <a href="{{ $profileUrl ?: route('about') . '#tim-kami' }}" class="flex flex-1 flex-col">
                            {{-- Foto Profil (rasio 3:4) --}}
                            <div class="relative mb-5 aspect-[3/4] w-full overflow-hidden rounded-xl bg-navy/5">
                                @if ($photoUrl)
                                    <img src="{{ $photoUrl }}" alt="{{ $member->name }}"
                                         class="h-full w-full object-cover object-top transition duration-500 group-hover:scale-105">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-navy/10 text-gold-dark/60">
                                        <x-heroicon-o-user class="h-20 w-20" />
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-navy/60 via-transparent to-transparent opacity-0 transition duration-300 group-hover:opacity-100"></div>
                            </div>

                            {{-- Peran & Nama --}}
                            <span class="mb-1 inline-block text-xs font-semibold uppercase tracking-wider text-gold-dark">
                                {{ $member->role }}
                            </span>
                            <h3 class="text-xl font-bold text-navy transition duration-200 group-hover:text-gold-dark">
                                {{ $member->name }}
                            </h3>

                            @if ($profileUrl)
                                <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-gold-dark">
                                    Lihat Profil <x-heroicon-o-arrow-right class="h-4 w-4 transition group-hover:translate-x-1" />
                                </span>
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
