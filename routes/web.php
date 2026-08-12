<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\InfoPajakController;
use App\Http\Controllers\PageController;
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

// Halaman utama (page tersendiri, lebih detail)
Route::get('/layanan', [PageController::class, 'services'])->name('services.index');
Route::get('/layanan/{slug}', [PageController::class, 'serviceShow'])->name('services.show');
Route::get('/izin', [PageController::class, 'licenses'])->name('licenses');
Route::get('/tentang', [PageController::class, 'about'])->name('about');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');

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
        ->add(Url::create(route('services.index'))->setPriority(0.9))
        ->add(Url::create(route('about'))->setPriority(0.8))
        ->add(Url::create(route('licenses'))->setPriority(0.7))
        ->add(Url::create(route('contact'))->setPriority(0.8))
        ->add(Url::create(route('articles.index'))->setPriority(0.8))
        ->add(Url::create(route('faq'))->setPriority(0.6))
        ->add(Url::create(route('tax-calendar'))->setPriority(0.6))
        ->add(Url::create(route('glossary'))->setPriority(0.6))
        ->add(Url::create(route('downloads'))->setPriority(0.6));

    Service::query()->where('is_active', true)->orderBy('order')->get()->each(
        fn (Service $service) => $sitemap->add(
            Url::create(route('services.show', $service->slug))->setPriority(0.6)
        )
    );

    Article::query()->published()->latest('published_at')->get()->each(
        fn (Article $article) => $sitemap->add(
            Url::create(route('articles.show', $article->slug))
                ->setLastModificationDate($article->updated_at)
                ->setPriority(0.7)
        )
    );

    return $sitemap->toResponse(request());
})->name('sitemap');

// Fallback route untuk menyajikan file storage secara otomatis di Hostinger Shared Hosting (tanpa butuh symlink/exec)
Route::get('/storage/{path}', function (string $path) {
    $filePath = storage_path('app/public/' . $path);
    if (! file_exists($filePath)) {
        abort(404);
    }

    return response()->file($filePath);
})->where('path', '.*')->name('storage.serve');

