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
                    @endphp
                    <div class="group relative flex flex-col overflow-hidden rounded-2xl border {{ $dark ? 'border-white/10 bg-white' : 'border-navy/10 bg-cream' }} p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-gold/50 hover:shadow-xl">
                        {{-- Foto Profil --}}
                        <div class="relative mb-6 aspect-[4/3] w-full overflow-hidden rounded-xl bg-navy/5">
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

                        {{-- Bio Singkat --}}
                        @if ($member->bio)
                            <p class="mt-3 flex-1 text-sm leading-relaxed text-navy/75">
                                {{ $member->bio }}
                            </p>
                        @endif

                        {{-- Kontak / Sosmed --}}
                        @if ($member->email || $member->linkedin_url)
                            <div class="mt-6 flex items-center gap-3 border-t border-navy/10 pt-4 text-xs font-medium text-navy/60">
                                @if ($member->email)
                                    <a href="mailto:{{ $member->email }}" class="inline-flex items-center gap-1 transition hover:text-gold-dark" title="Kirim Email">
                                        <x-heroicon-o-envelope class="h-4 w-4 text-gold-dark" />
                                        <span>{{ $member->email }}</span>
                                    </a>
                                @endif
                                @if ($member->linkedin_url)
                                    <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener" class="ml-auto inline-flex items-center gap-1 transition hover:text-gold-dark" title="Profil LinkedIn">
                                        <svg class="h-4 w-4 fill-current text-gold-dark" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
