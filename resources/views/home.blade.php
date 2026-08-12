<x-layouts.app>
    <x-sections.hero :settings="$settings" />
    <x-sections.licenses :licenses="$licenses" />
    <x-sections.services :services="$services" />
    <x-sections.about :settings="$settings" />
    <x-sections.team :members="$teamMembers" dark />
    <x-sections.values bg="bg-cream" />
    <x-sections.testimonials :testimonials="$testimonials" />
    <x-sections.latest-articles :articles="$latestArticles" />
    <x-sections.contact :settings="$settings" :show-form="false" bg="bg-white" />
</x-layouts.app>
