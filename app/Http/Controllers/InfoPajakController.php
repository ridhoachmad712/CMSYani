<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\Faq;
use App\Models\GlossaryTerm;
use App\Models\TaxCalendarEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InfoPajakController extends Controller
{
    public function faq()
    {
        $faqs = Faq::query()->active()->orderBy('order')->get()->groupBy(fn ($f) => $f->category ?: 'Lainnya');

        return view('public.faq', ['faqGroups' => $faqs]);
    }

    public function taxCalendar()
    {
        $events = TaxCalendarEvent::query()->active()->orderBy('order')->get()->groupBy('category');

        return view('public.tax-calendar', ['eventGroups' => $events]);
    }

    public function glossary(Request $request)
    {
        $terms = GlossaryTerm::query()
            ->active()
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = '%' . $request->string('q') . '%';
                $query->where(fn ($q) => $q->where('term', 'like', $term)->orWhere('definition', 'like', $term));
            })
            ->orderBy('term')
            ->get()
            ->groupBy(fn ($t) => mb_strtoupper(mb_substr($t->term, 0, 1)));

        return view('public.glossary', [
            'termGroups' => $terms,
            'search' => $request->string('q')->toString(),
        ]);
    }

    public function downloads()
    {
        $downloads = Download::query()->active()->orderBy('order')->get()->groupBy(fn ($d) => $d->category ?: 'Lainnya');

        return view('public.downloads', ['downloadGroups' => $downloads]);
    }

    public function downloadFile(Download $download)
    {
        abort_unless($download->is_active && $download->file, 404);

        $download->incrementQuietly('download_count');

        return Storage::disk('public')->download($download->file);
    }
}
