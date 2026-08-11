@props(['articles'])

@if ($articles->isNotEmpty())
    <section class="bg-cream py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 flex items-end justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-navy sm:text-4xl">Artikel Terbaru</h2>
                    <div class="mt-3 h-1 w-20 rounded bg-gold"></div>
                </div>
                <a href="{{ route('articles.index') }}" class="hidden text-sm font-semibold text-gold hover:underline sm:block">Lihat semua &rarr;</a>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($articles as $article)
                    <article class="flex flex-col overflow-hidden rounded-2xl border border-navy/10 bg-white shadow-sm transition hover:shadow-md">
                        @if ($article->featured_image)
                            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="h-40 w-full object-cover" loading="lazy">
                        @endif
                        <div class="flex flex-1 flex-col p-6">
                            @if ($article->category)
                                <span class="mb-2 self-start rounded-full bg-gold/15 px-3 py-0.5 text-xs font-medium text-gold">{{ $article->category->name }}</span>
                            @endif
                            <h3 class="text-lg font-semibold text-navy">
                                <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-gold">{{ $article->title }}</a>
                            </h3>
                            <p class="mt-2 flex-1 text-sm text-navy/70">{{ \Illuminate\Support\Str::limit($article->excerpt, 100) }}</p>
                            <a href="{{ route('articles.show', $article->slug) }}" class="mt-4 text-sm font-medium text-gold hover:underline">Baca selengkapnya &rarr;</a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-8 text-center sm:hidden">
                <a href="{{ route('articles.index') }}" class="text-sm font-semibold text-gold hover:underline">Lihat semua artikel &rarr;</a>
            </div>
        </div>
    </section>
@endif
