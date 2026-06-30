@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Tour Packages' : 'تورهای گردشگری')

@section('content')

<section class="relative py-20" style="background: linear-gradient(rgba(26, 26, 46, 0.85), rgba(22, 33, 62, 0.9)), url('https://images.unsplash.com/photo-1547981609-4b6bfe67ca0b?w=1920') center/cover;">
    <div class="container mx-auto px-4 text-center relative z-10">
        <h1 class="text-4xl lg:text-5xl font-black text-white mb-4">{{ app()->getLocale() === 'en' ? 'Tour Packages' : 'تورهای گردشگری' }}</h1>
        <p class="text-xl text-gray-300">{{ app()->getLocale() === 'en' ? 'Best travel packages to Afghanistan' : 'بهترین پکیج‌های سفر به افغانستان' }}</p>
    </div>
</section>

<section class="py-16 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($packages as $package)
            <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all group" data-aos="fade-up">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ $package->featured_image ? asset('storage/' . $package->featured_image) : 'https://via.placeholder.com/400' }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 left-4 gradient-gold text-primary-900 px-4 py-2 rounded-full font-black text-lg">
                        {{ number_format($package->final_price) }} اف
                    </div>
                    @if($package->discount_price)
                    <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">{{ app()->getLocale() === 'en' ? 'Sale' : 'تخفیف' }}</div>
                    @endif
                </div>
                <div class="p-5">
                    <span class="text-xs font-bold text-purple-500 bg-purple-50 dark:bg-purple-900/30 dark:text-purple-400 px-3 py-1 rounded-full">
                        @if($package->type === 'provincial')
                            {{ app()->getLocale() === 'en' ? 'Provincial' : 'ولایتی' }}
                        @elseif($package->type === 'regional')
                            {{ app()->getLocale() === 'en' ? 'Regional' : 'منطقه‌ای' }}
                        @elseif($package->type === 'thematic')
                            {{ app()->getLocale() === 'en' ? 'Thematic' : 'موضوعی' }}
                        @else
                            {{ app()->getLocale() === 'en' ? 'Custom' : 'سفارشی' }}
                        @endif
                    </span>
                    <h3 class="text-lg font-black text-gray-800 dark:text-white mt-3 mb-2">{{ locale_field($package, 'name') }}</h3>
                    <div class="flex gap-3 text-sm text-gray-500 dark:text-gray-400 mb-3">
                        <span><i class="far fa-clock text-blue-500 ms-1"></i> {{ $package->duration_days }} {{ app()->getLocale() === 'en' ? 'Days' : 'روز' }} / {{ $package->duration_nights }} {{ app()->getLocale() === 'en' ? 'Nights' : 'شب' }}</span>
                        <span><i class="fas fa-user text-blue-500 ms-1"></i> {{ $package->max_travelers }} {{ app()->getLocale() === 'en' ? 'People' : 'نفر' }}</span>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">{{ Str::limit(locale_field($package, 'description'), 80) }}</p>
                    <a href="{{ route('packages.show', $package->slug) }}"
                       class="block text-center gradient-btn text-white py-3 rounded-xl font-bold">
                        {{ app()->getLocale() === 'en' ? 'View & Book' : 'مشاهده و رزرو' }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        {{ $packages->links() }}
    </div>
</section>

@endsection
