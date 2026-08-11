<x-layouts.app title="Artikel Pajak" description="Artikel dan edukasi seputar perpajakan dari KAP Muhammad Yani.">
    <x-page-hero title="Artikel Pajak" subtitle="Wawasan dan edukasi seputar perpajakan untuk membantu kepatuhan Anda." />

    <section class="bg-cream py-14 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            {{-- Filter & pencarian --}}
            <form method="GET" class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('articles.index') }}"
                       class="rounded-full px-4 py-1.5 text-sm font-medium transition {{ $activeCategory === '' ? 'bg-navy text-cream' : 'bg-white text-navy/70 hover:bg-navy/10' }}">
                        Semua
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('articles.index', ['kategori' => $category->slug]) }}"
                           class="rounded-full px-4 py-1.5 text-sm font-medium transition {{ $activeCategory === $category->slug ? 'bg-navy text-cream' : 'bg-white text-navy/70 hover:bg-navy/10' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
                <div class="flex gap-2">
                    <input type="text" name="q" value="{{ $search }}" placeholder="Cari artikel..."
                           class="rounded-full border border-navy/20 px-4 py-2 text-sm focus:border-gold focus:outline-none focus:ring-1 focus:ring-gold">
                    <button type="submit" class="rounded-full bg-gold px-4 py-2 text-sm font-semibold text-navy">Cari</button>
                </div>
            </form>

            @if ($articles->count() > 0)
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($articles as $article)
                        <article class="flex flex-col overflow-hidden rounded-2xl border border-navy/10 bg-white shadow-sm transition hover:shadow-md">
                            @if ($article->featured_image)
                                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="h-44 w-full object-cover" loading="lazy">
                            @else
                                <div class="flex h-44 w-full items-center justify-center bg-navy/5 text-navy/30">
                                    <x-heroicon-o-newspaper class="h-10 w-10" />
                                </div>
                            @endif
                            <div class="flex flex-1 flex-col p-6">
                                @if ($article->category)
                                    <span class="mb-2 self-start rounded-full bg-gold/15 px-3 py-0.5 text-xs font-medium text-gold-dark">{{ $article->category->name }}</span>
                                @endif
                                <h2 class="text-lg font-semibold text-navy">
                                    <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-gold-dark">{{ $article->title }}</a>
                                </h2>
                                <p class="mt-2 flex-1 text-sm text-navy/70">{{ \Illuminate\Support\Str::limit($article->excerpt, 120) }}</p>
                                <div class="mt-4 flex items-center justify-between text-xs text-navy/50">
                                    <span>{{ optional($article->published_at ?? $article->created_at)->translatedFormat('d M Y') }}</span>
                                    <a href="{{ route('articles.show', $article->slug) }}" class="font-medium text-gold-dark hover:underline">Baca &rarr;</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $articles->links() }}
                </div>
            @else
                <x-empty-state message="Belum ada artikel yang tayang. Nantikan artikel edukasi pajak dari kami." />
            @endif
        </div>
    </section>
</x-layouts.app>
