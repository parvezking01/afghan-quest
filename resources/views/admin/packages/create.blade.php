@extends('layouts.admin')

@section('title', 'افزودن پکیج جدید')
@section('page_title', 'افزودن پکیج تور')
@section('page_subtitle', 'اطلاعات پکیج گردشگری را وارد کنید')

@section('content')

    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-8">
            <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-8">
                    <h3
                        class="text-lg font-black text-gray-800 dark:text-white mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                        📋 اطلاعات اصلی</h3>

                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">نام پکیج (دری)
                                *</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="مثال: تور بامیان و بند امیر" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English Name <span
                                    class="text-gray-400 text-xs">(اختیاری)</span></label>
                            <input type="text" name="name_en" value="{{ old('name_en') }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                                dir="ltr" placeholder="Bamyan & Band-e-Amir Tour">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">نوع پکیج *</label>
                            <select name="type"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                                <option value="provincial">🏛️ ولایتی (یک ولایت)</option>
                                <option value="regional">🗺️ منطقه‌ای (چند ولایت)</option>
                                <option value="thematic">🎯 موضوعی (تاریخی، طبیعی، فرهنگی)</option>
                                <option value="custom">✏️ سفارشی</option>
                            </select>
                        </div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">تعداد روز
                                *</label><input type="number" name="duration_days" value="{{ old('duration_days', 3) }}"
                                min="1"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required></div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">تعداد شب
                                *</label><input type="number" name="duration_nights"
                                value="{{ old('duration_nights', 2) }}" min="0"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required></div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">قیمت (افغانی)
                                *</label><input type="number" name="price" value="{{ old('price') }}" min="0"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="۱۵۰۰۰" required></div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">قیمت تخفیفی <span
                                    class="text-gray-400 text-xs">(اختیاری)</span></label><input type="number"
                                name="discount_price" value="{{ old('discount_price') }}" min="0"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="۱۲۰۰۰"></div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">شماره واتساپ برای
                                رزرو *</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp') }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 text-left"
                                dir="ltr" placeholder="+93 700 000 000" required>
                        </div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">حداکثر ظرفیت
                                *</label><input type="number" name="max_travelers" value="{{ old('max_travelers', 10) }}"
                                min="1"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required></div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ترتیب
                                نمایش</label><input type="number" name="display_order"
                                value="{{ old('display_order', 0) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">توضیحات (دری) *</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="توضیحات کامل پکیج..." required>{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English Description
                            <span class="text-gray-400 text-xs">(اختیاری)</span></label>
                        <textarea name="description_en" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                            dir="ltr" placeholder="Full package description...">{{ old('description_en') }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">مقاصد شامل <span
                                class="text-gray-400 text-xs">(اختیاری)</span></label>
                        <div
                            class="grid grid-cols-3 gap-2 max-h-40 overflow-y-auto border border-gray-200 dark:border-gray-600 rounded-xl p-3">
                            @foreach ($destinations as $dest)
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 p-1 rounded">
                                    <input type="checkbox" name="destinations[]" value="{{ $dest->id }}"
                                        class="rounded border-gray-300 text-blue-500">
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $dest->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6"><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">✅ خدمات
                            شامل</label>
                        <textarea name="included_services" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="راهنمای تور&#10;ترانسفر از کابل&#10;اقامت در هتل">{{ old('included_services') }}</textarea>
                    </div>
                    <div class="mb-6"><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">❌
                            خدمات شامل نمی‌شود</label>
                        <textarea name="excluded_services" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="پرواز&#10;انعام">{{ old('excluded_services') }}</textarea>
                    </div>
                    <div class="mb-6"><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">📅
                            برنامه سفر</label>
                        <textarea name="itinerary" rows="6"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="روز ۱: حرکت از کابل به سمت بامیان">{{ old('itinerary') }}</textarea>
                    </div>

                    <label class="flex items-center gap-3 cursor-pointer mt-4">
                        <input type="checkbox" name="includes_guide" value="1" checked
                            class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-blue-500">
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-300">👨‍🏫 شامل راهنمای تور</span>
                    </label>
                </div>

                <div class="mb-8">
                    <h3
                        class="text-lg font-black text-gray-800 dark:text-white mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                        🖼️ تصاویر</h3>
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">تصویر شاخص *</label>
                        <div class="flex items-start gap-4">
                            <div
                                class="w-40 h-40 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center overflow-hidden flex-shrink-0 border-2 border-gray-200 dark:border-gray-600">
                                <img id="featuredPreview" src="#" class="hidden w-full h-full object-cover"
                                    style="display:none;">
                                <i id="featuredPlaceholder" class="fas fa-image text-4xl text-gray-400"></i>
                            </div>
                            <div class="flex-1">
                                <label for="featured_image"
                                    class="block border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-4 text-center hover:border-blue-400 cursor-pointer bg-gray-50 dark:bg-gray-700 transition-all">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-blue-500 mb-2"></i>
                                    <p class="text-sm font-bold text-gray-600 dark:text-gray-300">انتخاب تصویر شاخص</p>
                                </label>
                                <input type="file" name="featured_image" id="featured_image" class="hidden"
                                    accept="image/*"
                                    onchange="previewImage(this, 'featuredPreview', 'featuredPlaceholder')" required>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">گالری <span
                                class="text-gray-400 text-xs">(اختیاری)</span></label>
                        <div
                            class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-4 hover:border-blue-400 cursor-pointer bg-gray-50 dark:bg-gray-700">
                            <label for="gallery_images" class="cursor-pointer block text-center"><i
                                    class="fas fa-images text-3xl text-blue-500 mb-2"></i>
                                <p class="text-sm font-bold text-gray-600 dark:text-gray-300">انتخاب چند عکس</p>
                            </label>
                            <input type="file" name="gallery_images[]" id="gallery_images" class="hidden"
                                accept="image/*" multiple onchange="previewGallery()">
                        </div>
                        <div id="galleryPreview" class="grid grid-cols-4 gap-3 mt-3"></div>
                    </div>
                </div>

                <div class="flex gap-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4">
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" name="is_trending"
                            value="1" class="w-5 h-5 rounded"><span
                            class="text-sm font-bold text-gray-700 dark:text-gray-300">⭐ پرطرفدار</span></label>
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" name="is_active"
                            value="1" checked class="w-5 h-5 rounded"><span
                            class="text-sm font-bold text-gray-700 dark:text-gray-300">✅ فعال</span></label>
                </div>

                <div class="flex gap-3 mt-8">
                    <button type="submit"
                        class="flex-1 bg-blue-500 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-600 hover:shadow-lg transition-all"><i
                            class="fas fa-save ms-1"></i> ذخیره پکیج</button>
                    <a href="{{ route('admin.packages.index') }}"
                        class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-8 py-4 rounded-xl font-bold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">انصراف</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input, previewId, placeholderId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                    document.getElementById(previewId).style.display = 'block';
                    if (placeholderId) document.getElementById(placeholderId).style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewGallery() {
            const files = document.getElementById('gallery_images').files;
            const container = document.getElementById('galleryPreview');
            container.innerHTML = '';
            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg">`;
                    container.appendChild(div);
                };
                reader.readAsDataURL(files[i]);
            }
        }
    </script>

@endsection
