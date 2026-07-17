@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Tourist Destinations' : 'مکان های گردشگری')

@section('content')

    <section class="relative py-20"
        style="background: linear-gradient(rgba(26, 26, 46, 0.85), rgba(22, 33, 62, 0.9)), url('{{ asset('images/KABUL.jpg') }}') center/cover;">
        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-4xl lg:text-5xl font-black text-white mb-4">
                {{ app()->getLocale() === 'en' ? 'Tourist Destinations' : 'مکان های گردشگری' }}</h1>
            <p class="text-xl text-gray-300">
                {{ app()->getLocale() === 'en' ? 'The most amazing places in Afghanistan' : 'شگفت‌انگیزترین نقاط افغانستان' }}
            </p>
        </div>
    </section>

    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($destinations as $destination)
                    <a href="{{ route('destinations.show', $destination->slug) }}"
                        class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all"
                        data-aos="fade-up">
                        <div class="relative h-52 overflow-hidden">
                            <img src="{{ $destination->featured_image ? asset('storage/' . $destination->featured_image) : 'https://via.placeholder.com/400' }}"
                                alt="{{ locale_field($destination, 'name') }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div
                                class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-bold text-white
                        {{ $destination->difficulty_level === 'easy' ? 'bg-green-500' : ($destination->difficulty_level === 'moderate' ? 'bg-yellow-500' : 'bg-red-500') }}">
                                @if ($destination->difficulty_level === 'easy')
                                    {{ app()->getLocale() === 'en' ? 'Easy' : 'آسان' }}
                                @elseif($destination->difficulty_level === 'moderate')
                                    {{ app()->getLocale() === 'en' ? 'Moderate' : 'متوسط' }}@else{{ app()->getLocale() === 'en' ? 'Hard' : 'سخت' }}
                                @endif
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="text-sm text-blue-500 font-bold mb-1">
                                {{ locale_field($destination->province, 'name') }}</div>
                            <h3 class="text-lg font-black text-gray-800 dark:text-white mb-2">
                                {{ locale_field($destination, 'name') }}</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">
                                {{ Str::limit(locale_field($destination, 'description'), 80) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            {{ $destinations->links() }}
        </div>
    </section>

@endsection
