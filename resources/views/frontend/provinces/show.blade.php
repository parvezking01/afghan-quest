@extends('layouts.app')

@section('title', locale_field($province, 'name'))
@section('meta_description', Str::limit(strip_tags(locale_field($province, 'description')), 160))
@section('meta_keywords', locale_field($province, 'name') . ', ' . $province->name_en . ', Afghanistan tourism,
    province')
@section('og_image', $province->featured_image ? asset('storage/' . $province->featured_image) :
    asset('images/default.jpg'))

@section('content')

    <!-- Hero -->
    <section class="relative py-24"
        style="background: linear-gradient(rgba(26, 26, 46, 0.8), rgba(22, 33, 62, 0.85)), url('{{ $province->featured_image ? asset('storage/' . $province->featured_image) : 'https://images.unsplash.com/photo-1599070292747-ae92ea606fcf?w=1920' }}') center/cover;">
        <div class="container mx-auto px-4 text-center relative z-10">
            <span class="bg-gold-500 text-primary-900 px-4 py-2 rounded-full text-sm font-bold inline-block mb-4">
                @if ($province->safety_level === 'safe')
                    {{ app()->getLocale() === 'en' ? '🟢 Safe' : '🟢 امن' }}
                @elseif($province->safety_level === 'moderate')
                    {{ app()->getLocale() === 'en' ? '🟡 Moderate' : '🟡 متوسط' }}
                @else
                    {{ app()->getLocale() === 'en' ? '🔴 Caution' : '🔴 احتیاط' }}
                @endif
            </span>
            <h1 class="text-4xl lg:text-6xl font-black text-white mb-4">{{ locale_field($province, 'name') }}</h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto">{{ locale_field($province, 'description') }}</p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    @if ($province->history)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm mb-6">
                            <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">
                                {{ app()->getLocale() === 'en' ? '📜 History' : '📜 تاریخچه' }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                {{ locale_field($province, 'history') }}</p>
                        </div>
                    @endif

                    @if ($province->culture)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm mb-6">
                            <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">
                                {{ app()->getLocale() === 'en' ? '🎭 Culture & Traditions' : '🎭 فرهنگ و رسوم' }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                {{ locale_field($province, 'culture') }}</p>
                        </div>
                    @endif

                    <!-- Destinations -->
                    @if ($province->destinations->count() > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm mb-6">
                            <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">
                                {{ app()->getLocale() === 'en' ? '🏛️ Tourist Destinations' : '🏛️ مقاصد گردشگری' }}</h3>
                            <div class="grid md:grid-cols-2 gap-4">
                                @foreach ($province->destinations as $destination)
                                    <a href="{{ route('destinations.show', $destination->slug) }}"
                                        class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                        <img src="{{ $destination->featured_image ? asset('storage/' . $destination->featured_image) : 'https://via.placeholder.com/60' }}"
                                            class="w-16 h-16 rounded-xl object-cover">
                                        <div>
                                            <h5
                                                class="font-bold text-gray-700 dark:text-gray-200 group-hover:text-blue-500 transition-colors">
                                                {{ locale_field($destination, 'name') }}</h5>
                                            <p class="text-xs text-gray-400 dark:text-gray-500">
                                                @if ($destination->difficulty_level === 'easy')
                                                    {{ app()->getLocale() === 'en' ? 'Easy' : 'آسان' }}
                                                @elseif($destination->difficulty_level === 'moderate')
                                                    {{ app()->getLocale() === 'en' ? 'Moderate' : 'متوسط' }}
                                                @else
                                                    {{ app()->getLocale() === 'en' ? 'Challenging' : 'سخت' }}
                                                @endif
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Hotels -->
                    @if ($province->hotels->count() > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm">
                            <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">
                                {{ app()->getLocale() === 'en' ? '🏨 Hotels' : '🏨 هتل‌ها' }}</h3>
                            <div class="grid md:grid-cols-2 gap-4">
                                @foreach ($province->hotels as $hotel)
                                    <a href="{{ route('hotels.show', $hotel->slug) }}"
                                        class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                        <img src="{{ $hotel->featured_image ? asset('storage/' . $hotel->featured_image) : 'https://via.placeholder.com/60' }}"
                                            class="w-16 h-16 rounded-xl object-cover">
                                        <div>
                                            <h5
                                                class="font-bold text-gray-700 dark:text-gray-200 group-hover:text-blue-500">
                                                {{ locale_field($hotel, 'name') }}</h5>
                                            <p class="text-xs text-gray-400 dark:text-gray-500">
                                                {{ locale_field($hotel, 'address') }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div>
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm sticky top-24">
                        <h4 class="font-black text-gray-800 dark:text-white mb-4">
                            {{ app()->getLocale() === 'en' ? 'ℹ️ Information' : 'ℹ️ اطلاعات' }}</h4>

                        @if ($province->best_time_to_visit)
                            <div class="mb-4">
                                <p class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ app()->getLocale() === 'en' ? 'Best Time to Visit' : 'بهترین زمان بازدید' }}</p>
                                <p class="text-gray-500 dark:text-gray-400">
                                    {{ locale_field($province, 'best_time_to_visit') }}</p>
                            </div>
                        @endif

                        @if ($province->local_food)
                            <div class="mb-4">
                                <p class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ app()->getLocale() === 'en' ? 'Local Food' : 'غذاهای محلی' }}</p>
                                <p class="text-gray-500 dark:text-gray-400">{{ locale_field($province, 'local_food') }}</p>
                            </div>
                        @endif

                        @if ($province->transportation_info)
                            <div class="mb-4">
                                <p class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ app()->getLocale() === 'en' ? 'Transportation' : 'حمل و نقل' }}</p>
                                <p class="text-gray-500 dark:text-gray-400">
                                    {{ locale_field($province, 'transportation_info') }}</p>
                            </div>
                        @endif

                        @if ($province->gallery_images)
                            <div class="mt-6">
                                <p class="text-sm font-bold text-gray-600 dark:text-gray-300 mb-3">
                                    {{ app()->getLocale() === 'en' ? 'Gallery' : 'گالری تصاویر' }}</p>
                                <div class="grid grid-cols-2 gap-2">
                                    @foreach (json_decode($province->gallery_images) as $index => $image)
                                        <img src="{{ asset('storage/' . $image) }}"
                                            class="w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-80 transition-opacity"
                                            onclick="openLightbox({{ $index }})"
                                            data-src="{{ asset('storage/' . $image) }}">
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <a href="{{ route('packages.index') }}"
                            class="block text-center gradient-btn text-white py-3 rounded-xl font-bold mt-6">
                            🎯 {{ app()->getLocale() === 'en' ? 'View Tours of' : 'مشاهده تورهای' }}
                            {{ locale_field($province, 'name') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @include('frontend.partials.reviews', ['reviewable' => $province])
    </section>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 z-50 hidden bg-black/90 flex items-center justify-center"
        onclick="closeLightbox(event)">
        <button onclick="closeLightbox()" class="absolute top-4 left-4 text-white text-3xl hover:text-gray-300 z-50"><i
                class="fas fa-times"></i></button>
        <button onclick="prevImage(event)"
            class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-4xl hover:text-gray-300 z-50 p-4"><i
                class="fas fa-chevron-right"></i></button>
        <img id="lightboxImage" src="" class="max-h-[90vh] max-w-[90vw] object-contain rounded-xl"
            onclick="event.stopPropagation()">
        <button onclick="nextImage(event)"
            class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-4xl hover:text-gray-300 z-50 p-4"><i
                class="fas fa-chevron-left"></i></button>
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white text-sm bg-black/50 px-4 py-2 rounded-full"
            id="lightboxCounter"></div>
    </div>

    <script>
        let currentIndex = 0;
        const galleryImages = document.querySelectorAll('[data-src]');
        const imageArray = Array.from(galleryImages).map(img => img.dataset.src);

        function openLightbox(index) {
            currentIndex = index;
            document.getElementById('lightboxImage').src = imageArray[currentIndex];
            document.getElementById('lightbox').classList.remove('hidden');
            document.getElementById('lightboxCounter').textContent = (currentIndex + 1) + ' / ' + imageArray.length;
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox(event) {
            if (event && event.target !== document.getElementById('lightbox')) return;
            document.getElementById('lightbox').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function nextImage(event) {
            event.stopPropagation();
            currentIndex = (currentIndex + 1) % imageArray.length;
            document.getElementById('lightboxImage').src = imageArray[currentIndex];
            document.getElementById('lightboxCounter').textContent = (currentIndex + 1) + ' / ' + imageArray.length;
        }

        function prevImage(event) {
            event.stopPropagation();
            currentIndex = (currentIndex - 1 + imageArray.length) % imageArray.length;
            document.getElementById('lightboxImage').src = imageArray[currentIndex];
            document.getElementById('lightboxCounter').textContent = (currentIndex + 1) + ' / ' + imageArray.length;
        }
        document.addEventListener('keydown', function(e) {
            if (document.getElementById('lightbox').classList.contains('hidden')) return;
            if (e.key === 'ArrowLeft') nextImage(e);
            if (e.key === 'ArrowRight') prevImage(e);
            if (e.key === 'Escape') closeLightbox();
        });
    </script>

@endsection
