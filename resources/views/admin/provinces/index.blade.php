@extends('layouts.admin')

@section('title', 'مدیریت ولایات')
@section('page_title', 'مدیریت ولایات')
@section('page_subtitle', 'لیست تمام ولایات افغانستان')

@section('content')

<!-- Header Actions -->
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-gray-500 dark:text-gray-400">کل: <span class="font-bold text-gray-700 dark:text-white">{{ $provinces->total() }}</span> ولایت</p>
    </div>
    <a href="{{ route('admin.provinces.create') }}"
       class="bg-blue-500 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-600 transition-colors">
        <i class="fas fa-plus ms-1"></i> افزودن ولایت جدید
    </a>
</div>

<!-- Provinces Table -->
<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-700/50">
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">#</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">نام ولایت</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">نام انگلیسی</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">مکان‌ها</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">هوتل‌ها</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">امنیت</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">پرطرفدار</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">وضعیت</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">عملیات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                @forelse($provinces as $province)
                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                    <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-400">{{ $province->display_order }}</td>
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center text-lg">
                                🏛️
                            </div>
                            <div>
                                <p class="font-bold text-gray-700 dark:text-white">{{ $province->name }}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">{{ Str::limit($province->description, 50) }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-400">{{ $province->name_en ?? '-' }}</td>
                    <td class="py-4 px-6">
                        <span class="bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 px-3 py-1 rounded-lg text-xs font-bold">
                            {{ $province->destinations_count }} مکان
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <span class="bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 px-3 py-1 rounded-lg text-xs font-bold">
                            {{ $province->hotels_count }} هوتل
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <span class="px-3 py-1 rounded-lg text-xs font-bold
                            {{ $province->safety_level === 'safe' ? 'bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400' : '' }}
                            {{ $province->safety_level === 'moderate' ? 'bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400' : '' }}
                            {{ $province->safety_level === 'caution' ? 'bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400' : '' }}">
                            @if($province->safety_level === 'safe')
                                🟢 امن
                            @elseif($province->safety_level === 'moderate')
                                🟡 متوسط
                            @else
                                🔴 احتیاط
                            @endif
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        @if($province->is_trending)
                            <span class="bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 px-3 py-1 rounded-lg text-xs font-bold">⭐ پرطرفدار</span>
                        @else
                            <span class="text-gray-400 dark:text-gray-500 text-xs">-</span>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        <span class="px-3 py-1 rounded-lg text-xs font-bold
                            {{ $province->is_active ? 'bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400' : 'bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500' }}">
                            {{ $province->is_active ? '✅ فعال' : '⛔ غیرفعال' }}
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.provinces.edit', $province) }}"
                               class="bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 p-2 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors" title="ویرایش">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.provinces.destroy', $province) }}" method="POST"
                                  onsubmit="return confirm('آیا مطمئن هستید؟')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400 p-2 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors" title="حذف">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-12">
                        <div class="text-5xl mb-4">🗺️</div>
                        <h3 class="text-lg font-bold text-gray-600 dark:text-gray-300 mb-2">هیچ ولایتی وجود ندارد</h3>
                        <p class="text-gray-400 dark:text-gray-500 mb-4">اولین ولایت را اضافه کنید</p>
                        <a href="{{ route('admin.provinces.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded-xl font-bold hover:bg-blue-600 transition-colors inline-block">
                            <i class="fas fa-plus ms-1"></i> افزودن ولایت
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($provinces->hasPages())
    <div class="p-4 border-t border-gray-100 dark:border-gray-700">
        {{ $provinces->links() }}
    </div>
    @endif
</div>

@endsection
