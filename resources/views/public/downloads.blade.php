<x-layouts.app title="Pusat Unduhan" description="Formulir dan panduan perpajakan yang dapat diunduh.">
    <x-page-hero title="Pusat Unduhan" subtitle="Formulir, panduan, dan dokumen perpajakan yang dapat Anda unduh." />

    <section class="bg-cream py-14 sm:py-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            @if ($downloadGroups->count() > 0)
                @foreach ($downloadGroups as $category => $downloads)
                    <div class="mb-10">
                        <h2 class="mb-4 text-xl font-semibold text-navy">{{ $category }}</h2>
                        <div class="grid gap-4 sm:grid-cols-2">
                            @foreach ($downloads as $download)
                                <div class="flex items-start gap-4 rounded-2xl border border-navy/10 bg-white p-5">
                                    <span class="flex h-11 w-11 flex-none items-center justify-center rounded-full bg-navy/5 text-navy">
                                        <x-heroicon-o-document-arrow-down class="h-6 w-6" />
                                    </span>
                                    <div class="flex-1">
                                        <p class="font-medium text-navy">{{ $download->title }}</p>
                                        @if ($download->description)
                                            <p class="mt-1 text-sm text-navy/65">{{ $download->description }}</p>
                                        @endif
                                        <a href="{{ route('downloads.file', $download) }}"
                                           class="mt-3 inline-flex items-center gap-1 text-sm font-semibold text-gold hover:underline">
                                            Unduh <x-heroicon-o-arrow-down-tray class="h-4 w-4" />
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <x-empty-state message="Belum ada berkas yang tersedia untuk diunduh." />
            @endif
        </div>
    </section>
</x-layouts.app>
