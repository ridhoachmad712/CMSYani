<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;

class PageController extends Controller
{
    public function services()
    {
        return view('public.services.index', [
            'settings' => SiteSetting::cached(),
            'services' => Service::query()->where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function serviceShow(string $slug)
    {
        $service = Service::query()->where('is_active', true)->where('slug', $slug)->firstOrFail();

        $others = Service::query()
            ->where('is_active', true)
            ->where('id', '!=', $service->id)
            ->orderBy('order')
            ->get();

        return view('public.services.show', [
            'settings' => SiteSetting::cached(),
            'service' => $service,
            'others' => $others,
        ]);
    }

    public function licenses()
    {
        return view('public.licenses', [
            'settings' => SiteSetting::cached(),
            'licenses' => License::query()->orderBy('order')->get(),
        ]);
    }

    public function about()
    {
        return view('public.about', [
            'settings' => SiteSetting::cached(),
            'licenses' => License::query()->orderBy('order')->get(),
            'teamMembers' => TeamMember::query()->active()->orderBy('order')->get(),
        ]);
    }

    public function teamShow(string $slug)
    {
        $member = TeamMember::query()->active()->where('slug', $slug)->firstOrFail();

        $others = TeamMember::query()
            ->active()
            ->where('id', '!=', $member->id)
            ->orderBy('order')
            ->get();

        return view('public.team.show', [
            'settings' => SiteSetting::cached(),
            'member' => $member,
            'others' => $others,
        ]);
    }

    public function contact()
    {
        return view('public.contact', [
            'settings' => SiteSetting::cached(),
        ]);
    }
}
