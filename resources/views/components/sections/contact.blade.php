@props(['settings', 'showHeading' => true, 'showForm' => true, 'bg' => 'bg-cream'])

@php
    $waNumber = preg_replace('/\D/', '', (string) $settings->whatsapp_number);
    $mapQuery = urlencode((string) $settings->address);
@endphp

<section id="kontak" class="border-t border-navy/5 {{ $bg }} py-14 sm:py-20 lg:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if ($showHeading)
            <x-section-heading
                class="reveal"
                :eyebrow="site_text('kontak_eyebrow')"
                :title="site_text('kontak_title')"
                :subtitle="$showForm ? 'Sampaikan kebutuhan perpajakan Anda. Kami siap membantu memberikan solusi terbaik.' : site_text('kontak_subtitle')" />
        @endif

        <div class="mt-14 grid gap-10 {{ $showForm ? 'lg:grid-cols-2' : '' }}">
            {{-- Info kontak + peta --}}
            <div class="{{ $showForm ? '' : 'grid items-start gap-10 lg:grid-cols-2' }}">
                <ul class="space-y-5">
                    @if ($settings->address)
                        <li class="flex gap-4">
                            <span class="flex h-11 w-11 flex-none items-center justify-center rounded-full bg-navy text-gold">
                                <x-heroicon-o-map-pin class="h-5 w-5" />
                            </span>
                            <span class="text-navy/80">{{ $settings->address }}</span>
                        </li>
                    @endif
                    @if ($settings->phone_primary)
                        <li class="flex gap-4">
                            <span class="flex h-11 w-11 flex-none items-center justify-center rounded-full bg-navy text-gold">
                                <x-heroicon-o-phone class="h-5 w-5" />
                            </span>
                            <span class="text-navy/80">
                                {{ $settings->phone_primary }}@if ($settings->phone_secondary)<br>{{ $settings->phone_secondary }}@endif
                            </span>
                        </li>
                    @endif
                    @if ($settings->email)
                        <li class="flex gap-4">
                            <span class="flex h-11 w-11 flex-none items-center justify-center rounded-full bg-navy text-gold">
                                <x-heroicon-o-envelope class="h-5 w-5" />
                            </span>
                            <a href="mailto:{{ $settings->email }}" class="text-navy/80 hover:text-gold">{{ $settings->email }}</a>
                        </li>
                    @endif
                </ul>

                @if ($settings->address)
                    <div class="mt-8 overflow-hidden rounded-2xl border border-navy/10 shadow-sm {{ $showForm ? '' : 'lg:mt-0' }}">
                        <iframe
                            src="https://www.google.com/maps?q={{ $mapQuery }}&output=embed"
                            width="100%" height="{{ $showForm ? 280 : 320 }}" style="border:0;" allowfullscreen loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Peta lokasi kantor"></iframe>
                    </div>
                @endif
            </div>

            {{-- Form konsultasi (Livewire) --}}
            @if ($showForm)
                <div class="rounded-2xl border border-navy/10 bg-white p-6 shadow-sm sm:p-8">
                    <h3 class="mb-6 text-xl font-semibold text-navy">Form Konsultasi</h3>
                    @livewire('contact-form')
                </div>
            @endif
        </div>
    </div>
</section>
