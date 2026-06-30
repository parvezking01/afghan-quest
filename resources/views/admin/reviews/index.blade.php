@extends('layouts.admin')

@section('title', 'مدیریت نظرات')
@section('page_title', 'مدیریت نظرات')
@section('page_subtitle', 'بررسی و تایید نظرات کاربران')

@section('content')

<!-- Filter Tabs -->
<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-4 mb-6">
    <div class="flex gap-2">
        <a href="{{ route('admin.reviews.index') }}"
           class="px-4 py-2 rounded-xl text-sm font-bold transition-all {{ !request('status') ? 'bg-gray-800 dark:bg-gray-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
            همه
        </a>
        <a href="{{ route('admin.reviews.index', ['status' => 'pending']) }}"
           class="px-4 py-2 rounded-xl text-sm font-bold transition-all {{ request('status') === 'pending' ? 'bg-yellow-500 text-white' : 'bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400 hover:bg-yellow-100 dark:hover:bg-yellow-900/30' }}">
            ⏳ در انتظار تایید
        </a>
        <a href="{{ route('admin.reviews.index', ['status' => 'approved']) }}"
           class="px-4 py-2 rounded-xl text-sm font-bold transition-all {{ request('status') === 'approved' ? 'bg-green-500 text-white' : 'bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-900/30' }}">
            ✅ تایید شده
        </a>
    </div>
</div>

<!-- Reviews Table -->
<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-700/50">
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">کاربر</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">نوع</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">مورد</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">امتیاز</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">نظر</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">وضعیت</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">تاریخ</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">عملیات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                @forelse($reviews as $review)
                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50">
                    <td class="py-4 px-4">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold text-xs">
                                {{ mb_substr($review->user->name ?? '?', 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $review->user->name ?? 'ناشناس' }}</span>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="px-2 py-1 rounded-lg text-xs font-bold bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                            @php
                                $type = class_basename($review->reviewable_type);
                                $typeNames = [
                                    'Province' => 'ولایت',
                                    'Destination' => 'مقصد',
                                    'Hotel' => 'هتل',
                                    'Package' => 'پکیج',
                                ];
                            @endphp
                            {{ $typeNames[$type] ?? $type }}
                        </span>
                    </td>
                    <td class="py-4 px-4 text-sm text-gray-600 dark:text-gray-300">
                        {{ $review->reviewable->name ?? '-' }}
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-yellow-400 dark:text-yellow-300 text-sm">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating) ⭐ @else ☆ @endif
                            @endfor
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <p class="text-sm text-gray-600 dark:text-gray-300 max-w-xs">{{ Str::limit($review->comment, 80) }}</p>
                    </td>
                    <td class="py-4 px-4">
                        <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $review->is_approved ? 'bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400' : 'bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400' }}">
                            {{ $review->is_approved ? '✅ تایید شده' : '⏳ در انتظار' }}
                        </span>
                    </td>
                    <td class="py-4 px-4 text-sm text-gray-400 dark:text-gray-500">{{ $review->created_at->format('Y-m-d') }}</td>
                    <td class="py-4 px-4">
                        <div class="flex gap-2">
                            <form action="{{ route('admin.reviews.approve', $review) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="p-2 rounded-lg text-xs font-bold {{ $review->is_approved ? 'bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 hover:bg-yellow-100 dark:hover:bg-yellow-900/50' : 'bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-900/50' }}" title="{{ $review->is_approved ? 'لغو تایید' : 'تایید' }}">
                                    <i class="fas {{ $review->is_approved ? 'fa-times' : 'fa-check' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('آیا مطمئن هستید؟')">
                                @csrf @method('DELETE')
                                <button class="bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400 p-2 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-12 text-gray-400 dark:text-gray-500">
                        <div class="text-5xl mb-4">⭐</div>
                        <h3 class="text-lg font-bold text-gray-600 dark:text-gray-300">هیچ نظری وجود ندارد</h3>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($reviews->hasPages())
    <div class="p-4 border-t border-gray-100 dark:border-gray-700">{{ $reviews->links() }}</div>
    @endif
</div>

@endsection
