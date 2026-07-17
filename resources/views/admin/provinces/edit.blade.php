@extends('layouts.admin')

@section('title', 'ویرایش ولایت')
@section('page_title', 'ویرایش: ' . $province->name)
@section('page_subtitle', 'اطلاعات ولایت را بروزرسانی کنید')

@section('content')

    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-8">
            <form action="{{ route('admin.provinces.update', $province) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">نام ولایت (دری)
                            *</label>
                        <input type="text" name="name" value="{{ old('name', $province->name) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English Name <span
                                class="text-gray-400 text-xs">(اختیاری)</span></label>
                        <input type="text" name="name_en" value="{{ old('name_en', $province->name_en) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                            dir="ltr">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">سطح امنیت *</label>
                        <select name="safety_level"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                            <option value="safe" {{ $province->safety_level === 'safe' ? 'selected' : '' }}>🟢 امن
                            </option>
                            <option value="moderate" {{ $province->safety_level === 'moderate' ? 'selected' : '' }}>🟡 متوسط
                            </option>
                            <option value="caution" {{ $province->safety_level === 'caution' ? 'selected' : '' }}>🔴 احتیاط
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ترتیب نمایش</label>
                        <input type="number" name="display_order"
                            value="{{ old('display_order', $province->display_order) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Dari Description -->
                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">توضیحات (دری) *</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>{{ old('description', $province->description) }}</textarea>
                </div>

                <!-- English Description -->
                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English Description <span
                            class="text-gray-400 text-xs">(اختیاری)</span></label>
                    <textarea name="description_en" rows="4"
                        class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                        dir="ltr" placeholder="English description...">{{ old('description_en', $province->description_en) }}</textarea>
                </div>

                <!-- FEATURED IMAGE -->
                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">تصویر شاخص</label>
                    @if ($province->featured_image)
                        <div
                            class="mb-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-3 flex items-center gap-3">
                            <i class="fas fa-image text-amber-500"></i>
                            <span class="text-sm text-amber-700 dark:text-amber-400">تصویر فعلی موجود است. می‌توانید تصویر
                                جدید جایگزین کنید.</span>
                        </div>
                    @endif
                    <div class="flex items-start gap-4">
                        <div
                            class="w-40 h-40 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center overflow-hidden flex-shrink-0 border-2 border-gray-200 dark:border-gray-600">
                            @if ($province->featured_image)
                                <img id="featuredPreview" src="{{ asset('storage/' . $province->featured_image) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <img id="featuredPreview" src="#" class="hidden w-full h-full object-cover"
                                    style="display:none;">
                                <i id="featuredPlaceholder" class="fas fa-image text-4xl text-gray-400"></i>
                            @endif
                        </div>
                        <div class="flex-1">
                            <label for="featured_image"
                                class="block border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-4 text-center hover:border-blue-400 cursor-pointer bg-gray-50 dark:bg-gray-700">
                                <i class="fas fa-cloud-upload-alt text-2xl text-blue-500 mb-2"></i>
                                <p class="text-sm font-bold text-gray-600 dark:text-gray-300">تصویر جدید (اختیاری)</p>
                            </label>
                            <input type="file" name="featured_image" id="featured_image" class="hidden" accept="image/*"
                                onchange="previewImage(this, 'featuredPreview', 'featuredPlaceholder')">
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
                            <p class="text-sm font-bold text-gray-600 dark:text-gray-300">افزودن عکس جدید</p>
                        </label>
                        <input type="file" name="gallery_images[]" id="gallery_images" class="hidden" accept="image/*"
                            multiple onchange="previewGallery()">
                    </div>
                    <div id="galleryPreview" class="grid grid-cols-4 gap-3 mt-3"></div>
                    @if ($province->gallery_images && count(json_decode($province->gallery_images)) > 0)
                        <div class="mt-3">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">تصاویر فعلی گالری:</p>
                            <div class="grid grid-cols-4 gap-3">
                                @foreach (json_decode($province->gallery_images) as $image)
                                    <img src="{{ asset('storage/' . $image) }}"
                                        class="w-full h-24 object-cover rounded-lg">
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- History & Culture -->
                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">تاریخچه</label>
                        <textarea name="history" rows="3"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('history', $province->history) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">فرهنگ و رسوم</label>
                        <textarea name="culture" rows="3"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('culture', $province->culture) }}</textarea>
                    </div>
                </div>

                <!-- Best Time & Local Food -->
                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">بهترین زمان
                            بازدید</label>
                        <input type="text" name="best_time_to_visit"
                            value="{{ old('best_time_to_visit', $province->best_time_to_visit) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">غذاهای محلی</label>
                        <input type="text" name="local_food" value="{{ old('local_food', $province->local_food) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Transportation -->
                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">حمل و نقل</label>
                    <textarea name="transportation_info" rows="2"
                        class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('transportation_info', $province->transportation_info) }}</textarea>
                </div>

                <!-- Checkboxes -->
                <div class="flex gap-6 mt-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_trending" value="1"
                            {{ $province->is_trending ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-amber-500">
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-300">⭐ پرطرفدار</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1"
                            {{ $province->is_active ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-green-500">
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-300">✅ فعال</span>
                    </label>
                </div>

                <div class="flex gap-3 mt-8">
                    <button type="submit"
                        class="bg-blue-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-600 transition-colors">
                        <i class="fas fa-save ms-1"></i> بروزرسانی
                    </button>
                    <a href="{{ route('admin.provinces.index') }}"
                        class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-8 py-3 rounded-xl font-bold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">انصراف</a>
                </div>
            </form>

            <form action="{{ route('admin.provinces.destroy', $province) }}" method="POST"
                class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700"
                onsubmit="return confirm('آیا از حذف این ولایت مطمئن هستید؟')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm">
                    <i class="fas fa-trash ms-1"></i> حذف این ولایت
                </button>
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
