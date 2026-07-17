@extends('layouts.admin')

@section('title', 'مدیریت هوتل‌ها')
@section('page_title', 'مدیریت هوتل‌ها')
@section('page_subtitle', 'لیست تمام هوتل‌ها')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <p class="text-gray-500 dark:text-gray-400">کل: <span
                class="font-bold text-gray-700 dark:text-white">{{ $hotels->total() }}</span> هوتل</p>
        <a href="{{ route('admin.hotels.create') }}"
            class="bg-blue-500 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-600 transition-colors">
            <i class="fas fa-plus ms-1"></i> افزودن هوتل جدید
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50">
                        <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">تصویر
                        </th>
                        <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">نام
                            هوتل</th>
                        <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">ولایت
                        </th>
                        <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">مالک
                        </th>
                        <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">شماره
                            تماس</th>
                        <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">تایید
                        </th>
                        <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">وضعیت
                        </th>
                        <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">عملیات
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                    @forelse($hotels as $hotel)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="py-4 px-6">
                                <img src="{{ $hotel->featured_image ? asset('storage/' . $hotel->featured_image) : 'https://via.placeholder.com/48' }}"
                                    class="w-12 h-12 rounded-lg object-cover">
                            </td>
                            <td class="py-4 px-6">
                                <p class="font-bold text-gray-700 dark:text-white">{{ $hotel->name }}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">{{ Str::limit($hotel->address, 40) }}
                                </p>
                            </td>
                            <td class="py-4 px-6">
                                <span
                                    class="bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 px-3 py-1 rounded-lg text-xs font-bold">
                                    {{ $hotel->province->name ?? '-' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-600 dark:text-gray-300">{{ $hotel->owner->name ?? '-' }}
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-600 dark:text-gray-300">{{ $hotel->phone }}</td>
                            <td class="py-4 px-6">
                                <a href="{{ route('admin.hotels.approve', $hotel) }}"
                                    onclick="event.preventDefault(); document.getElementById('approve-{{ $hotel->id }}').submit();"
                                    class="px-3 py-1 rounded-lg text-xs font-bold cursor-pointer
                            {{ $hotel->is_approved ? 'bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400' : 'bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400' }}">
                                    {{ $hotel->is_approved ? '✅ تایید شده' : '⏳ در انتظار' }}
                                </a>
                                <form id="approve-{{ $hotel->id }}"
                                    action="{{ route('admin.hotels.approve', $hotel) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('PATCH')
                                </form>
                            </td>
                            <td class="py-4 px-6">
                                <span
                                    class="px-3 py-1 rounded-lg text-xs font-bold
                            {{ $hotel->is_active ? 'bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400' : 'bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500' }}">
                                    {{ $hotel->is_active ? '✅ فعال' : '⛔ غیرفعال' }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.hotels.edit', $hotel) }}"
                                        class="bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 p-2 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST">
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
                            <td colspan="8" class="text-center py-12">
                                <div class="text-5xl mb-4">🏨</div>
                                <h3 class="text-lg font-bold text-gray-600 dark:text-gray-300 mb-2">هیچ هوتلی وجود ندارد
                                </h3>
                                <a href="{{ route('admin.hotels.create') }}"
                                    class="bg-blue-500 text-white px-6 py-2 rounded-xl font-bold hover:bg-blue-600 transition-colors inline-block">
                                    افزودن هوتل جدید
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($hotels->hasPages())
            <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                {{ $hotels->links() }}
            </div>
        @endif
    </div>

@endsection
