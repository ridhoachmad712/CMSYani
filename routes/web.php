<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\InfoPajakController;
use App\Models\Article;
use App\Models\License;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Route::get('/', function () {
    return view('home', [
        'settings' => SiteSetting::cached(),
        'services' => Service::query()->where('is_active', true)->orderBy('order')->get(),
        'licenses' => License::query()->orderBy('order')->get(),
        'testimonials' => Testimonial::query()->active()->orderBy('order')->get(),
        'latestArticles' => Article::query()->published()->with('category')->latest('published_at')->limit(3)->get(),
    ]);
})->name('home');

// Artikel / Blog Pajak
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Info Pajak
Route::get('/faq', [InfoPajakController::class, 'faq'])->name('faq');
Route::get('/kalender-pajak', [InfoPajakController::class, 'taxCalendar'])->name('tax-calendar');
Route::get('/glosarium', [InfoPajakController::class, 'glossary'])->name('glossary');
Route::get('/unduhan', [InfoPajakController::class, 'downloads'])->name('downloads');
Route::get('/unduhan/{download}/berkas', [InfoPajakController::class, 'downloadFile'])->name('downloads.file');

// Sitemap dinamis (selalu mencakup halaman aktif + artikel terbit terbaru)
Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create(route('home'))->setPriority(1.0))
        ->add(Url::create(route('articles.index'))->setPriority(0.8))
        ->add(Url::create(route('faq'))->setPriority(0.6))
        ->add(Url::create(route('tax-calendar'))->setPriority(0.6))
        ->add(Url::create(route('glossary'))->setPriority(0.6))
        ->add(Url::create(route('downloads'))->setPriority(0.6));

    Article::query()->published()->latest('published_at')->get()->each(
        fn (Article $article) => $sitemap->add(
            Url::create(route('articles.show', $article->slug))
                ->setLastModificationDate($article->updated_at)
                ->setPriority(0.7)
        )
    );

    return $sitemap->toResponse(request());
})->name('sitemap');
