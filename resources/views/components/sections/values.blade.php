@php
    // Nilai inti dari brosur (01-project-brief.md bagian 5.5).
    $values = [
        ['title' => 'Profesional', 'icon' => 'heroicon-o-briefcase', 'desc' => 'Layanan yang kompeten, terukur, dan sesuai ketentuan perpajakan.'],
        ['title' => 'Integritas', 'icon' => 'heroicon-o-shield-check', 'desc' => 'Jujur, independen, dan menjunjung tinggi etika dalam setiap penanganan.'],
        ['title' => 'Kepercayaan', 'icon' => 'heroicon-o-user-group', 'desc' => 'Menjaga kerahasiaan dan membangun hubungan jangka panjang dengan klien.'],
    ];
@endphp

<section class="bg-white py-16">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 sm:grid-cols-3">
            @foreach ($values as $value)
                <div class="text-center">
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
