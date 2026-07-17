@extends('layouts.app')

@section('title', locale_field($destination, 'name'))

@section('content')

    <section class="relative py-24"
        style="background: linear-gradient(rgba(26, 26, 46, 0.8), rgba(22, 33, 62, 0.85)), url('{{ $destination->featured_image ? asset('storage/' . $destination->featured_image) : 'https://images.unsplash.com/photo-1599070292747-ae92ea606fcf?w=1920' }}') center/cover;">
        <div class="container mx-auto px-4 text-center relative z-10">
            <span
                class="text-blue-300 text-sm font-bold mb-3 block">{{ locale_field($destination->province, 'name') }}</span>
            <h1 class="text-4xl lg:text-6xl font-black text-white mb-4">{{ locale_field($destination, 'name') }}</h1>
            <div class="flex justify-center gap-3">
                <span
                    class="px-3 py-1 rounded-full text-sm text-white {{ $destination->difficulty_level === 'easy' ? 'bg-green-500' : ($destination->difficulty_level === 'moderate' ? 'bg-yellow-500' : 'bg-red-500') }}">
                    @if ($destination->difficulty_level === 'easy')
                        {{ app()->getLocale() === 'en' ? '🟢 Easy' : '🟢 آسان' }}
                    @elseif($destination->difficulty_level === 'moderate')
                        {{ app()->getLocale() === 'en' ? '🟡 Moderate' : '🟡 متوسط' }}
                    @else
                        {{ app()->getLocale() === 'en' ? '🔴 Challenging' : '🔴 سخت' }}
                    @endif
                </span>
                @if ($destination->best_season)
                    <span
                        class="bg-white/20 text-white px-3 py-1 rounded-full text-sm">{{ $destination->best_season }}</span>
                @endif
            </div>
        </div>
    </section>

    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm mb-6">
                        <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">
                            {{ app()->getLocale() === 'en' ? '📝 Description' : '📝 توضیحات' }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            {{ locale_field($destination, 'description') }}</p>
                    </div>

                    @if ($destination->highlights)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm mb-6">
                            <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">
                                {{ app()->getLocale() === 'en' ? '⭐ Highlights' : '⭐ نکات برجسته' }}</h3>
                            <p class="text-gray-600 dark:text-gray-300">{{ locale_field($destination, 'highlights') }}</p>
                        </div>
                    @endif

                    @if ($destination->gallery_images)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm mb-6">
                            <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">
                                {{ app()->getLocale() === 'en' ? '🖼️ Gallery' : '🖼️ گالری' }}</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach (json_decode($destination->gallery_images) as $image)
                                    <img src="{{ asset('storage/' . $image) }}"
                                        class="w-full h-40 object-cover rounded-xl">
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div>
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm sticky top-24">
                        <h4 class="font-black text-gray-800 dark:text-white mb-4">
                            {{ app()->getLocale() === 'en' ? 'ℹ️ Visit Info' : 'ℹ️ اطلاعات بازدید' }}</h4>

                        @if ($destination->estimated_visit_duration)
                            <div class="mb-4">
                                <p class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ app()->getLocale() === 'en' ? '⏱️ Duration' : '⏱️ مدت بازدید' }}</p>
                                <p class="text-gray-500 dark:text-gray-400">{{ $destination->estimated_visit_duration }}
                                </p>
                            </div>
                        @endif

                        @if ($destination->best_season)
                            <div class="mb-4">
                                <p class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ app()->getLocale() === 'en' ? '🌤️ Best Season' : '🌤️ بهترین فصل' }}</p>
                                <p class="text-gray-500 dark:text-gray-400">{{ $destination->best_season }}</p>
                            </div>
                        @endif

                        <a href="{{ route('packages.index') }}"
                            class="block text-center gradient-btn text-white py-3 rounded-xl font-bold mt-6">
                            🎯 {{ app()->getLocale() === 'en' ? 'View Available Tours' : 'مشاهده تورهای موجود' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @include('frontend.partials.reviews', ['reviewable' => $destination])
    </section>

@endsection
