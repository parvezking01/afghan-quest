@extends('layouts.admin')

@section('title', 'افزودن ولایت جدید')
@section('page_title', 'افزودن ولایت جدید')
@section('page_subtitle', 'اطلاعات ولایت را وارد کنید')

@section('content')

    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-8">
            <form action="{{ route('admin.provinces.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">نام ولایت (دری)
                            *</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English Name <span
                                class="text-gray-400 text-xs">(اختیاری)</span></label>
                        <input type="text" name="name_en" value="{{ old('name_en') }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                            dir="ltr">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">سطح امنیت *</label>
                        <select name="safety_level"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                            <option value="safe">🟢 امن</option>
                            <option value="moderate" selected>🟡 متوسط</option>
                            <option value="caution">🔴 احتیاط</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ترتیب نمایش</label>
                        <input type="number" name="display_order" value="{{ old('display_order', 0) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Dari Description -->
                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">توضیحات (دری) *</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>{{ old('description') }}</textarea>
                </div>

                <!-- English Description -->
                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English Description <span
                            class="text-gray-400 text-xs">(اختیاری)</span></label>
                    <textarea name="description_en" rows="4"
                        class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                        dir="ltr" placeholder="English description...">{{ old('description_en') }}</textarea>
                </div>

                <!-- FEATURED IMAGE -->
                <div class="mt-6">
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
                                class="block border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-4 text-center hover:border-blue-400 cursor-pointer bg-gray-50 dark:bg-gray-700">
                                <i class="fas fa-cloud-upload-alt text-2xl text-blue-500 mb-2"></i>
                                <p class="text-sm font-bold text-gray-600 dark:text-gray-300">انتخاب تصویر شاخص</p>
                                <p class="text-xs text-gray-400">JPG, PNG, WebP - Max 2MB</p>
                            </label>
                            <input type="file" name="featured_image" id="featured_image" class="hidden" accept="image/*"
                                onchange="previewImage(this, 'featuredPreview', 'featuredPlaceholder')" required>
                            <p class="text-xs text-gray-400 mt-2" id="featuredFileName"></p>
                        </div>
                    </div>
                </div>

                <!-- GALLERY IMAGES -->
                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">گالری تصاویر</label>
                    <div
                        class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-4 hover:border-blue-400 cursor-pointer bg-gray-50 dark:bg-gray-700">
                        <label for="gallery_images" class="cursor-pointer block text-center">
                            <i class="fas fa-images text-3xl text-blue-500 mb-2"></i>
                            <p class="text-sm font-bold text-gray-600 dark:text-gray-300">انتخاب چند عکس برای گالری</p>
                        </label>
                        <input type="file" name="gallery_images[]" id="gallery_images" class="hidden" accept="image/*"
                            multiple onchange="previewGallery()">
                    </div>
                    <div id="galleryPreview" class="grid grid-cols-4 gap-3 mt-3"></div>
                </div>

                <!-- History & Culture -->
                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">تاریخچه</label>
                        <textarea name="history" rows="3"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('history') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">فرهنگ و رسوم</label>
                        <textarea name="culture" rows="3"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('culture') }}</textarea>
                    </div>
                </div>

                <!-- Best Time & Local Food -->
                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">بهترین زمان
                            بازدید</label>
                        <input type="text" name="best_time_to_visit" value="{{ old('best_time_to_visit') }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">غذاهای محلی</label>
                        <input type="text" name="local_food" value="{{ old('local_food') }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Transportation -->
                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">حمل و نقل</label>
                    <textarea name="transportation_info" rows="2"
                        class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('transportation_info') }}</textarea>
                </div>

                <!-- Checkboxes -->
                <div class="flex gap-6 mt-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_trending" value="1"
                            class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-amber-500">
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-300">⭐ پرطرفدار</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked
                            class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-green-500">
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-300">✅ فعال</span>
                    </label>
                </div>

                <div class="flex gap-3 mt-8">
                    <button type="submit"
                        class="flex-1 bg-blue-500 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-600 transition-all">
                        <i class="fas fa-save ms-1"></i> ذخیره ولایت
                    </button>
                    <a href="{{ route('admin.provinces.index') }}"
                        class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-8 py-4 rounded-xl font-bold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        <i class="fas fa-times ms-1"></i> انصراف
                    </a>
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
                    document.getElementById(placeholderId).style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
                document.getElementById('featuredFileName').textContent = '📎 ' + input.files[0].name;
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
                    div.className = 'relative';
                    div.innerHTML =
                        `<img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg"><span class="absolute top-1 right-1 bg-green-500 text-white text-xs px-2 py-0.5 rounded-full">${i + 1}</span>`;
                    container.appendChild(div);
                };
                reader.readAsDataURL(files[i]);
            }
        }
    </script>

@endsection
