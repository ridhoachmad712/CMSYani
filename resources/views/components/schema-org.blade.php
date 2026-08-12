@props(['settings'])

@php
    $phone = $settings->phone_primary ?: $settings->whatsapp_number;
    $ogImage = asset('og-image.svg');

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'ProfessionalService',
        'name' => 'Kantor Konsultan Pajak dan Kuasa Hukum Pajak Muhammad Yani',
        'description' => $settings->hero_subtitle ?: 'Solusi profesional untuk kepatuhan pajak dan perlindungan hukum bisnis Anda.',
        'url' => url('/'),
        'image' => $ogImage,
        'logo' => $settings->logo_path ? asset('storage/' . $settings->logo_path) : $ogImage,
        'priceRange' => '$$',
        'areaServed' => 'Makassar, Sulawesi Selatan',
        'founder' => [
            '@type' => 'Person',
            'name' => 'Muhammad Yani, S.E., Ak., M.Ak., M.H., CTR., CPAFS., BKP.',
            'jobTitle' => 'Konsultan Pajak dan Kuasa Hukum Pajak',
        ],
    ];

    if ($settings->email) {
        $schema['email'] = $settings->email;
    }
    if ($phone) {
        $schema['telephone'] = $phone;
    }
    if ($settings->address) {
        $schema['address'] = [
            '@type' => 'PostalAddress',
            'streetAddress' => $settings->address,
            'addressLocality' => 'Makassar',
            'addressRegion' => 'Sulawesi Selatan',
            'addressCountry' => 'ID',
        ];
    }
    if ($settings->instagram_url) {
        $schema['sameAs'] = [$settings->instagram_url];
    }
@endphp

<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
