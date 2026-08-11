<?php

namespace Tests\Feature;

use App\Livewire\NewsletterForm;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Download;
use App\Models\NewsletterSubscriber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ContentPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_semua_halaman_info_pajak_dapat_diakses(): void
    {
        foreach (['/artikel', '/faq', '/kalender-pajak', '/glosarium', '/unduhan', '/sitemap.xml'] as $url) {
            $this->get($url)->assertSuccessful();
        }
    }

    public function test_artikel_terbit_tampil_draft_tidak(): void
    {
        $category = ArticleCategory::create(['name' => 'PPh', 'slug' => 'pph']);

        $published = Article::create([
            'title' => 'Panduan Lapor SPT', 'slug' => 'panduan-lapor-spt',
            'excerpt' => 'Ringkasan panduan.', 'content' => '<p>Isi artikel lengkap.</p>',
            'article_category_id' => $category->id, 'is_published' => true, 'published_at' => now()->subDay(),
        ]);

        $draft = Article::create([
            'title' => 'Draft Rahasia', 'slug' => 'draft-rahasia',
            'excerpt' => 'Belum tayang.', 'content' => '<p>Rahasia.</p>', 'is_published' => false,
        ]);

        // Listing hanya menampilkan yang terbit
        $this->get('/artikel')
            ->assertSuccessful()
            ->assertSee('Panduan Lapor SPT')
            ->assertDontSee('Draft Rahasia');

        // Detail artikel terbit tampil, view bertambah
        $this->get('/artikel/' . $published->slug)
            ->assertSuccessful()
            ->assertSee('Isi artikel lengkap', false);
        $this->assertSame(1, $published->fresh()->views_count);

        // Detail artikel draft => 404
        $this->get('/artikel/' . $draft->slug)->assertNotFound();
    }

    public function test_unduh_berkas_menambah_hitungan(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('downloads/formulir.pdf', 'dummy-pdf');

        $download = Download::create([
            'title' => 'Formulir SPT', 'file' => 'downloads/formulir.pdf',
            'category' => 'Formulir', 'is_active' => true,
        ]);

        $this->get(route('downloads.file', $download))
            ->assertSuccessful()
            ->assertDownload('formulir.pdf');

        $this->assertSame(1, $download->fresh()->download_count);
    }

    public function test_download_nonaktif_tidak_bisa_diunduh(): void
    {
        $download = Download::create([
            'title' => 'Rahasia', 'file' => 'downloads/x.pdf', 'is_active' => false,
        ]);

        $this->get(route('downloads.file', $download))->assertNotFound();
    }

    public function test_newsletter_menyimpan_email(): void
    {
        Livewire::test(NewsletterForm::class)
            ->set('email', 'calon@example.com')
            ->call('subscribe')
            ->assertHasNoErrors()
            ->assertSet('subscribed', true);

        $this->assertDatabaseHas('newsletter_subscribers', ['email' => 'calon@example.com', 'is_active' => true]);
    }

    public function test_newsletter_tidak_duplikat(): void
    {
        NewsletterSubscriber::create(['email' => 'ada@example.com', 'subscribed_at' => now()]);

        Livewire::test(NewsletterForm::class)
            ->set('email', 'ada@example.com')
            ->call('subscribe')
            ->assertHasNoErrors();

        $this->assertSame(1, NewsletterSubscriber::where('email', 'ada@example.com')->count());
    }
}
