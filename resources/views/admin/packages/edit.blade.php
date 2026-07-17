@extends('layouts.admin')

@section('title', 'ویرایش پکیج')
@section('page_title', 'ویرایش: ' . $package->name)
@section('page_subtitle', 'اطلاعات پکیج را بروزرسانی کنید')

@section('content')

    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-8">
            <form action="{{ route('admin.packages.update', $package) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-8">
                    <h3
                        class="text-lg font-black text-gray-800 dark:text-white mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                        📋 اطلاعات اصلی</h3>
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">نام پکیج (دری)
                                *</label><input type="text" name="name" value="{{ old('name', $package->name) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required></div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English Name <span
                                    class="text-gray-400 text-xs">(اختیاری)</span></label><input type="text"
                                name="name_en" value="{{ old('name_en', $package->name_en) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                                dir="ltr"></div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">نوع پکیج
                                *</label><select name="type"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                                <option value="provincial" {{ $package->type == 'provincial' ? 'selected' : '' }}>🏛️ ولایتی
                                </option>
                                <option value="regional" {{ $package->type == 'regional' ? 'selected' : '' }}>🗺️ منطقه‌ای
                                </option>
                                <option value="thematic" {{ $package->type == 'thematic' ? 'selected' : '' }}>🎯 موضوعی
                                </option>
                                <option value="custom" {{ $package->type == 'custom' ? 'selected' : '' }}>✏️ سفارشی</option>
                            </select></div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">تعداد روز
                                *</label><input type="number" name="duration_days"
                                value="{{ old('duration_days', $package->duration_days) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required></div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">تعداد شب
                                *</label><input type="number" name="duration_nights"
                                value="{{ old('duration_nights', $package->duration_nights) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required></div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">قیمت (افغانی)
                                *</label><input type="number" name="price" value="{{ old('price', $package->price) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required></div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">قیمت
                                تخفیفی</label><input type="number" name="discount_price"
                                value="{{ old('discount_price', $package->discount_price) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">شماره واتساپ
                                *</label><input type="text" name="whatsapp"
                                value="{{ old('whatsapp', $package->whatsapp) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 text-left"
                                dir="ltr" required></div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">حداکثر ظرفیت
                                *</label><input type="number" name="max_travelers"
                                value="{{ old('max_travelers', $package->max_travelers) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required></div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ترتیب
                                نمایش</label><input type="number" name="display_order"
                                value="{{ old('display_order', $package->display_order) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="mb-6"><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">توضیحات
                            (دری) *</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>{{ old('description', $package->description) }}</textarea>
                    </div>
                    <div class="mb-6"><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English
                            Description <span class="text-gray-400 text-xs">(اختیاری)</span></label>
                        <textarea name="description_en" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                            dir="ltr">{{ old('description_en', $package->description_en) }}</textarea>
                    </div>

                    <div class="mb-6"><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">مقاصد
                            شامل</label>
                        <div
                            class="grid grid-cols-3 gap-2 max-h-40 overflow-y-auto border border-gray-200 dark:border-gray-600 rounded-xl p-3">
                            @foreach ($destinations as $dest)
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 p-1 rounded"><input
                                        type="checkbox" name="destinations[]" value="{{ $dest->id }}"
                                        {{ $package->destinations->contains($dest->id) ? 'checked' : '' }}
                                        class="rounded"><span
                                        class="text-sm text-gray-700 dark:text-gray-300">{{ $dest->name }}</span></label>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-6"><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">✅ خدمات
                            شامل</label>
                        <textarea name="included_services" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('included_services', $package->included_services ? implode("\n", json_decode($package->included_services)) : '') }}</textarea>
                    </div>
                    <div class="mb-6"><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">❌ خدمات
                            شامل نمی‌شود</label>
                        <textarea name="excluded_services" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('excluded_services', $package->excluded_services ? implode("\n", json_decode($package->excluded_services)) : '') }}</textarea>
                    </div>
                    <div class="mb-6"><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">📅
                            برنامه سفر</label>
                        <textarea name="itinerary" rows="6"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('itinerary', $package->itinerary ? implode("\n", json_decode($package->itinerary)) : '') }}</textarea>
                    </div>
                    <label class="flex items-center gap-3 cursor-pointer mt-4"><input type="checkbox"
                            name="includes_guide" value="1" {{ $package->includes_guide ? 'checked' : '' }}
                            class="w-5 h-5 rounded"><span class="text-sm font-bold text-gray-700 dark:text-gray-300">👨‍🏫
                            شامل راهنمای تور</span></label>
                </div>

                <div class="mb-8">
                    <h3
                        class="text-lg font-black text-gray-800 dark:text-white mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                        🖼️ تصاویر</h3>
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">تصویر شاخص</label>
                        <div class="flex items-start gap-4">
                            <div
                                class="w-40 h-40 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center overflow-hidden flex-shrink-0 border-2 border-gray-200 dark:border-gray-600">
                                <img id="featuredPreview" src="{{ asset('storage/' . $package->featured_image) }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1"><label for="featured_image"
                                    class="block border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-4 text-center hover:border-blue-400 cursor-pointer bg-gray-50 dark:bg-gray-700"><i
                                        class="fas fa-cloud-upload-alt text-2xl text-blue-500 mb-2"></i>
                                    <p class="text-sm font-bold text-gray-600 dark:text-gray-300">تصویر جدید (اختیاری)</p>
                                </label><input type="file" name="featured_image" id="featured_image" class="hidden"
                                    accept="image/*" onchange="previewImage(this, 'featuredPreview', null)"></div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4">
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" name="is_trending"
                            value="1" {{ $package->is_trending ? 'checked' : '' }} class="w-5 h-5 rounded"><span
                            class="text-sm font-bold text-gray-700 dark:text-gray-300">⭐ پرطرفدار</span></label>
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" name="is_active"
                            value="1" {{ $package->is_active ? 'checked' : '' }} class="w-5 h-5 rounded"><span
                            class="text-sm font-bold text-gray-700 dark:text-gray-300">✅ فعال</span></label>
                </div>

                <div class="flex gap-3 mt-8">
                    <button type="submit"
                        class="bg-blue-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-600 transition-colors"><i
                            class="fas fa-save ms-1"></i> بروزرسانی</button>
                    <a href="{{ route('admin.packages.index') }}"
                        class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-8 py-3 rounded-xl font-bold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">انصراف</a>
                </div>
            </form>

            <form action="{{ route('admin.packages.destroy', $package) }}" method="POST"
                class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                @csrf @method('DELETE')
                <button type="button" onclick="confirmDelete(this.parentElement)"
                    class="text-red-500 hover:text-red-700 font-bold text-sm"><i class="fas fa-trash ms-1"></i> حذف این
                    پکیج</button>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
