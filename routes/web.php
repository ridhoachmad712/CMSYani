<?php

use App\Models\License;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'settings' => SiteSetting::cached(),
        'services' => Service::query()->where('is_active', true)->orderBy('order')->get(),
        'licenses' => License::query()->orderBy('order')->get(),
    ]);
})->name('home');
