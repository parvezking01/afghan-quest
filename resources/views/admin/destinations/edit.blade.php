@extends('layouts.admin')

@section('title', 'ویرایش مکان')
@section('page_title', 'ویرایش: ' . $destination->name)
@section('page_subtitle', 'اطلاعات مکان را بروزرسانی کنید')

@section('content')

    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-8">
            <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ولایت *</label>
                    <select name="province_id"
                        class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}"
                                {{ $destination->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">نام مکان (دری)
                            *</label>
                        <input type="text" name="name" value="{{ old('name', $destination->name) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English Name <span
                                class="text-gray-400 text-xs">(اختیاری)</span></label>
                        <input type="text" name="name_en" value="{{ old('name_en', $destination->name_en) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                            dir="ltr">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">سطح سختی *</label>
                        <select name="difficulty_level"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                            <option value="easy" {{ $destination->difficulty_level === 'easy' ? 'selected' : '' }}>🟢 آسان
                            </option>
                            <option value="moderate" {{ $destination->difficulty_level === 'moderate' ? 'selected' : '' }}>
                                🟡 متوسط</option>
                            <option value="challenging"
                                {{ $destination->difficulty_level === 'challenging' ? 'selected' : '' }}>🔴 سخت</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">بهترین فصل</label>
                        <input type="text" name="best_season" value="{{ old('best_season', $destination->best_season) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">مدت بازدید</label>
                        <input type="text" name="estimated_visit_duration"
                            value="{{ old('estimated_visit_duration', $destination->estimated_visit_duration) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ترتیب نمایش</label>
                        <input type="number" name="display_order"
                            value="{{ old('display_order', $destination->display_order) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Dari Description -->
                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">توضیحات (دری) *</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>{{ old('description', $destination->description) }}</textarea>
                </div>

                <!-- English Description -->
                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English Description <span
                            class="text-gray-400 text-xs">(اختیاری)</span></label>
                    <textarea name="description_en" rows="4"
                        class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                        dir="ltr" placeholder="English description...">{{ old('description_en', $destination->description_en) }}</textarea>
                </div>

                <!-- Highlights -->
                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">نکات برجسته</label>
                    <textarea name="highlights" rows="3"
                        class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('highlights', $destination->highlights) }}</textarea>
                </div>

                <!-- Featured Image -->
                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">تصویر شاخص</label>
                    <div class="flex items-start gap-4">
                        <div
                            class="w-40 h-40 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center overflow-hidden flex-shrink-0 border-2 border-gray-200 dark:border-gray-600">
                            <img id="featuredPreview" src="{{ asset('storage/' . $destination->featured_image) }}"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <label for="featured_image"
                                class="block border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-4 text-center hover:border-blue-400 cursor-pointer bg-gray-50 dark:bg-gray-700">
                                <i class="fas fa-cloud-upload-alt text-2xl text-blue-500 mb-2"></i>
                                <p class="text-sm font-bold text-gray-600 dark:text-gray-300">تصویر جدید (اختیاری)</p>
                            </label>
                            <input type="file" name="featured_image" id="featured_image" class="hidden" accept="image/*"
                                onchange="previewImage(this, 'featuredPreview', null)">
                        </div>
                    </div>
                </div>

                <!-- Gallery -->
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
                    @if ($destination->gallery_images && count(json_decode($destination->gallery_images)) > 0)
                        <div class="mt-3">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">تصاویر فعلی:</p>
                            <div class="grid grid-cols-4 gap-3">
                                @foreach (json_decode($destination->gallery_images) as $image)
                                    <img src="{{ asset('storage/' . $image) }}"
                                        class="w-full h-24 object-cover rounded-lg">
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="flex gap-6 mt-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_trending" value="1"
                            {{ $destination->is_trending ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-amber-500">
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-300">⭐ پرطرفدار</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1"
                            {{ $destination->is_active ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-green-500">
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-300">✅ فعال</span>
                    </label>
                </div>

                <div class="flex gap-3 mt-8">
                    <button type="submit"
                        class="bg-blue-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-600 transition-colors">
                        <i class="fas fa-save ms-1"></i> بروزرسانی
                    </button>
                    <a href="{{ route('admin.destinations.index') }}"
                        class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-8 py-3 rounded-xl font-bold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">انصراف</a>
                </div>
            </form>

            <form action="{{ route('admin.destinations.destroy', $destination) }}" method="POST"
                class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDelete(this.parentElement)"
                    class="text-red-500 hover:text-red-700 font-bold text-sm">
                    <i class="fas fa-trash ms-1"></i> حذف این مکان
                </button>
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
