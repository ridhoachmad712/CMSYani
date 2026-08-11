<x-layouts.app :title="$article->meta_title ?: $article->title" :description="$article->meta_description ?: $article->excerpt">
    <x-page-hero :title="$article->title" />

    <article class="bg-cream py-14 sm:py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex flex-wrap items-center gap-3 text-sm text-navy/60">
                @if ($article->category)
                    <span class="rounded-full bg-gold/15 px-3 py-0.5 font-medium text-gold-dark">{{ $article->category->name }}</span>
                @endif
                <span>{{ $article->author_name }}</span>
                <span>&middot;</span>
                <span>{{ optional($article->published_at ?? $article->created_at)->translatedFormat('d F Y') }}</span>
            </div>

            @if ($article->featured_image)
                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="mb-8 w-full rounded-2xl object-cover" loading="lazy">
            @endif

            <div class="prose prose-navy max-w-none text-navy/85">
                {!! $article->content !!}
            </div>

            <div class="mt-10 border-t border-navy/10 pt-6">
                <a href="{{ route('articles.index') }}" class="text-sm font-medium text-gold-dark hover:underline">&larr; Kembali ke daftar artikel</a>
            </div>
        </div>

        @if ($related->count() > 0)
            <div class="mx-auto mt-14 max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="mb-6 text-2xl font-bold text-navy">Artikel Terkait</h2>
                <div class="grid gap-6 sm:grid-cols-3">
                    @foreach ($related as $item)
                        <a href="{{ route('articles.show', $item->slug) }}" class="rounded-2xl border border-navy/10 bg-white p-5 shadow-sm transition hover:shadow-md">
                            <h3 class="font-semibold text-navy">{{ $item->title }}</h3>
                            <p class="mt-2 text-sm text-navy/65">{{ \Illuminate\Support\Str::limit($item->excerpt, 90) }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </article>
</x-layouts.app>
