@extends('layouts.admin')

@section('title', 'مدیریت پکیج‌ها')
@section('page_title', 'مدیریت پکیج‌های تور')
@section('page_subtitle', 'لیست تمام پکیج‌های گردشگری')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 dark:text-gray-400">کل: <span class="font-bold text-gray-700 dark:text-white">{{ $packages->total() }}</span> پکیج</p>
    <a href="{{ route('admin.packages.create') }}"
       class="bg-blue-500 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-600 transition-colors">
        <i class="fas fa-plus ms-1"></i> افزودن پکیج جدید
    </a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-700/50">
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">تصویر</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">نام پکیج</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">نوع</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">مدت</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">قیمت</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">ظرفیت</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">پرطرفدار</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">وضعیت</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">عملیات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                @forelse($packages as $package)
                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                    <td class="py-4 px-6">
                        <img src="{{ $package->featured_image ? asset('storage/' . $package->featured_image) : 'https://via.placeholder.com/48' }}"
                             class="w-12 h-12 rounded-lg object-cover">
                    </td>
                    <td class="py-4 px-6">
                        <p class="font-bold text-gray-700 dark:text-white">{{ $package->name }}</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500">{{ Str::limit($package->description, 50) }}</p>
                    </td>
                    <td class="py-4 px-6">
                        <span class="bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 px-3 py-1 rounded-lg text-xs font-bold">
                            {{ $package->type === 'provincial' ? 'ولایتی' : ($package->type === 'regional' ? 'منطقه‌ای' : ($package->type === 'thematic' ? 'موضوعی' : 'سفارشی')) }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-sm text-gray-600 dark:text-gray-300">
                        {{ $package->duration_days }} روز / {{ $package->duration_nights }} شب
                    </td>
                    <td class="py-4 px-6">
                        <p class="font-bold text-gray-700 dark:text-white">{{ number_format($package->price) }} اف</p>
                        @if($package->discount_price)
                        <p class="text-xs text-red-500 dark:text-red-400 line-through">{{ number_format($package->discount_price) }} اف</p>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-sm text-gray-600 dark:text-gray-300">{{ $package->max_travelers }} نفر</td>
                    <td class="py-4 px-6">
                        @if($package->is_trending)
                            <span class="bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 px-3 py-1 rounded-lg text-xs font-bold">⭐ بله</span>
                        @else
                            <span class="text-gray-400 dark:text-gray-500 text-xs">-</span>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $package->is_active ? 'bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400' : 'bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500' }}">
                            {{ $package->is_active ? '✅ فعال' : '⛔ غیرفعال' }}
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.packages.edit', $package) }}"
                               class="bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 p-2 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.packages.destroy', $package) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete(this.parentElement)"
                                        class="bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400 p-2 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-12">
                        <div class="text-5xl mb-4">📦</div>
                        <h3 class="text-lg font-bold text-gray-600 dark:text-gray-300 mb-2">هیچ پکیجی وجود ندارد</h3>
                        <a href="{{ route('admin.packages.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded-xl font-bold hover:bg-blue-600 transition-colors inline-block">
                            افزودن پکیج جدید
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($packages->hasPages())
    <div class="p-4 border-t border-gray-100 dark:border-gray-700">{{ $packages->links() }}</div>
    @endif
</div>

@endsection
