<x-layouts.app title="Kalender Pajak" description="Jadwal jatuh tempo pelaporan dan pembayaran pajak.">
    <x-page-hero title="Kalender Pajak" subtitle="Ringkasan jatuh tempo pelaporan dan pembayaran pajak. Selalu konfirmasikan tanggal pasti sesuai ketentuan DJP terbaru." />

    <section class="bg-cream py-14 sm:py-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            @if ($eventGroups->count() > 0)
                @foreach ($eventGroups as $category => $events)
                    <div class="mb-10">
                        <h2 class="mb-4 flex items-center gap-2 text-xl font-semibold text-navy">
                            <span class="h-2 w-2 rounded-full bg-gold"></span> {{ $category }}
                        </h2>
                        <div class="overflow-hidden rounded-2xl border border-navy/10 bg-white">
                            @foreach ($events as $event)
                                <div class="flex flex-col gap-1 border-b border-navy/5 px-5 py-4 last:border-0 sm:flex-row sm:items-center sm:justify-between">
                                    <div>
                                        <p class="font-medium text-navy">{{ $event->title }}</p>
                                        @if ($event->description)
                                            <p class="text-sm text-navy/60">{{ $event->description }}</p>
                                        @endif
                                    </div>
                                    <span class="mt-1 self-start rounded-full bg-navy/5 px-3 py-1 text-sm text-navy/80 sm:mt-0 sm:self-auto">{{ $event->due_rule }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <p class="mt-4 text-center text-xs text-navy/50">
                    Informasi bersifat umum dan dapat berubah sesuai peraturan terbaru. Untuk kepastian, silakan berkonsultasi dengan kami.
                </p>
            @else
                <x-empty-state message="Kalender pajak sedang disiapkan dan akan segera tersedia." />
            @endif
        </div>
    </section>
</x-layouts.app>
