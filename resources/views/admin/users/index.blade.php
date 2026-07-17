@extends('layouts.admin')

@section('title', 'مدیریت کاربران')
@section('page_title', 'مدیریت کاربران')
@section('page_subtitle', 'لیست تمام کاربران سیستم')

@section('content')

    <!-- Stats -->
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 text-center">
            <p class="text-3xl font-black text-gray-700 dark:text-white">{{ $users->total() }}</p>
            <p class="text-gray-400 dark:text-gray-500 text-sm">کل کاربران</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 text-center">
            <p class="text-3xl font-black text-blue-600 dark:text-blue-400">
                {{ \App\Models\User::where('role', 'tourist')->count() }}</p>
            <p class="text-gray-400 dark:text-gray-500 text-sm">🧳 گردشگران</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 text-center">
            <p class="text-3xl font-black text-yellow-600 dark:text-yellow-400">
                {{ \App\Models\User::where('role', 'hotel_owner')->count() }}</p>
            <p class="text-gray-400 dark:text-gray-500 text-sm">🏨 مالکان هتل</p>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-4 mb-6">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <!-- Filter Tabs -->
            <div class="flex gap-2">
                <a href="{{ route('admin.users.index') }}"
                    class="px-4 py-2 rounded-xl text-sm font-bold transition-all {{ !request('role') ? 'bg-blue-500 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                    همه
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'tourist']) }}"
                    class="px-4 py-2 rounded-xl text-sm font-bold transition-all {{ request('role') === 'tourist' ? 'bg-blue-500 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                    🧳 گردشگران
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'hotel_owner']) }}"
                    class="px-4 py-2 rounded-xl text-sm font-bold transition-all {{ request('role') === 'hotel_owner' ? 'bg-yellow-500 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                    🏨 مالکان هتل
                </a>
            </div>

            <!-- Search -->
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-2">
                @if (request('role'))
                    <input type="hidden" name="role" value="{{ request('role') }}">
                @endif
                <input type="text" name="search" value="{{ request('search') }}" placeholder="جستجوی نام یا ایمیل..."
                    class="px-4 py-2 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 w-64">
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-xl hover:bg-blue-600 transition-colors">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Users Table -->
    <div
        class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50">
                        <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">کاربر
                        </th>
                        <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">ایمیل
                        </th>
                        <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">نقش
                        </th>
                        <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">شماره
                        </th>
                        <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">وضعیت
                        </th>
                        <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">تاریخ
                        </th>
                        <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">عملیات
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50">
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm
                                {{ $user->role === 'admin' ? 'bg-red-500' : ($user->role === 'hotel_owner' ? 'bg-yellow-500' : 'bg-blue-500') }}">
                                        {{ mb_substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-700 dark:text-white">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-400 dark:text-gray-500">
                                            {{ $user->whatsapp ?? $user->phone }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-600 dark:text-gray-300">{{ $user->email }}</td>
                            <td class="py-4 px-4">
                                <span
                                    class="px-3 py-1 rounded-lg text-xs font-bold
                            {{ $user->role === 'admin' ? 'bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400' : '' }}
                            {{ $user->role === 'hotel_owner' ? 'bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400' : '' }}
                            {{ $user->role === 'tourist' ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : '' }}">
                                    @if ($user->role === 'admin')
                                        👑 مدیر
                                    @elseif($user->role === 'hotel_owner')
                                        🏨 مالک
                                    @else
                                        🧳 گردشگر
                                    @endif
                                </span>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-600 dark:text-gray-300">{{ $user->phone ?? '-' }}</td>
                            <td class="py-4 px-4">
                                @if ($user->role !== 'admin')
                                    <form action="{{ route('admin.users.approve', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="px-3 py-1 rounded-lg text-xs font-bold cursor-pointer transition-colors
                                    {{ $user->is_approved ? 'bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-900/50' : 'bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 hover:bg-yellow-100 dark:hover:bg-yellow-900/50' }}">
                                            {{ $user->is_approved ? '✅ تایید شده' : '⏳ در انتظار' }}
                                        </button>
                                    </form>
                                @else
                                    <span
                                        class="bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 px-3 py-1 rounded-lg text-xs font-bold">✅
                                        مدیر</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-400 dark:text-gray-500">
                                {{ $user->created_at->format('Y-m-d') }}</td>
                            <td class="py-4 px-4">
                                @if ($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                        onsubmit="return confirm('آیا از حذف این کاربر مطمئن هستید؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400 p-2 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-12 text-gray-400 dark:text-gray-500">
                                <div class="text-5xl mb-4">🔍</div>
                                <h3 class="text-lg font-bold text-gray-600 dark:text-gray-300">هیچ کاربری یافت نشد</h3>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="p-4 border-t border-gray-100 dark:border-gray-700">{{ $users->links() }}</div>
        @endif
    </div>

@endsection
