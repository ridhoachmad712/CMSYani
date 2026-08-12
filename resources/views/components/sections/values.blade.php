@props(['bg' => 'bg-white'])

@php
    // Nilai inti dari brosur (01-project-brief.md bagian 5.5).
    $values = [
        ['title' => site_text('nilai1_title'), 'icon' => 'heroicon-o-briefcase', 'desc' => site_text('nilai1_desc')],
        ['title' => site_text('nilai2_title'), 'icon' => 'heroicon-o-shield-check', 'desc' => site_text('nilai2_desc')],
        ['title' => site_text('nilai3_title'), 'icon' => 'heroicon-o-user-group', 'desc' => site_text('nilai3_desc')],
    ];
@endphp

<section class="border-t border-navy/5 {{ $bg }} py-14 sm:py-16">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="reveal grid gap-6 sm:grid-cols-3">
            @foreach ($values as $value)
                <div class="rounded-2xl border-t-4 border-gold bg-white p-7 text-center shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-navy text-gold">
                        <x-dynamic-component :component="$value['icon']" class="h-8 w-8" />
                    </div>
                    <h3 class="text-xl font-semibold text-navy">{{ $value['title'] }}</h3>
                    <p class="mt-2 text-sm text-navy/65">{{ $value['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
