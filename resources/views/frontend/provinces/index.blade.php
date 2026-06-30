@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Provinces of Afghanistan' : 'ولایات افغانستان')

@section('content')

<section class="relative py-20" style="background: linear-gradient(rgba(26, 26, 46, 0.85), rgba(22, 33, 62, 0.9)), url('https://images.unsplash.com/photo-1547981609-4b6bfe67ca0b?w=1920') center/cover;">
    <div class="container mx-auto px-4 text-center relative z-10">
        <h1 class="text-4xl lg:text-5xl font-black text-white mb-4">{{ app()->getLocale() === 'en' ? 'Provinces of Afghanistan' : 'ولایات افغانستان' }}</h1>
        <p class="text-xl text-gray-300">{{ app()->getLocale() === 'en' ? 'Explore the 34 beautiful provinces of Afghanistan' : 'کاوش در ۳۴ ولایت زیبای افغانستان' }}</p>
    </div>
</section>

<section class="py-16 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($provinces as $province)
            <a href="{{ route('provinces.show', $province->slug) }}"
               class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300"
               data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="relative h-48 overflow-hidden">
                    @if($province->featured_image)
                        <img src="{{ asset('storage/' . $province->featured_image) }}"
                             alt="{{ locale_field($province, 'name') }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                            <i class="fas fa-map-marked-alt text-white text-5xl opacity-50"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 right-4 text-white">
                        <h3 class="text-xl font-black">{{ locale_field($province, 'name') }}</h3>
                        <p class="text-sm text-gray-300">{{ $province->name_en }}</p>
                    </div>
                </div>
                <div class="p-5">
                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">{{ Str::limit(locale_field($province, 'description'), 100) }}</p>
                    <div class="flex items-center gap-4 mt-4 text-xs text-gray-500 dark:text-gray-400">
                        <span><i class="fas fa-landmark text-blue-500 ms-1"></i> {{ $province->destinations_count ?? 0 }} {{ app()->getLocale() === 'en' ? 'Destinations' : 'مقصد' }}</span>
                        <span><i class="fas fa-hotel text-emerald-500 ms-1"></i> {{ $province->hotels_count ?? 0 }} {{ app()->getLocale() === 'en' ? 'Hotels' : 'هتل' }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        {{ $provinces->links() }}
    </div>
</section>

@endsection
