@extends('layouts.admin')

@section('title', 'ویرایش ولایت')
@section('page_title', 'ویرایش: ' . $province->name)
@section('page_subtitle', 'اطلاعات ولایت را بروزرسانی کنید')

@section('content')

    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-8 lg:p-10">

            <!-- UPDATE FORM -->
            <form action="{{ route('admin.provinces.update', $province) }}" method="POST" enctype="multipart/form-data" id="updateForm">
                @csrf
                @method('PUT')

                <!-- SECTION 1: Basic Info & Settings -->
                <div class="border-b border-gray-100 dark:border-gray-700 pb-8">
                    <h3 class="text-lg font-black text-gray-800 dark:text-white mb-6">اطلاعات پایه</h3>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Names -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">نام ولایت (دری) *</label>
                            <input type="text" name="name" value="{{ old('name', $province->name) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English Name <span class="text-gray-400 text-xs">(اختیاری)</span></label>
                            <input type="text" name="name_en" value="{{ old('name_en', $province->name_en) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 text-left transition-all"
                                dir="ltr">
                        </div>

                        <!-- Order & Status (Perfectly balanced row) -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ترتیب نمایش</label>
                            <input type="number" name="display_order" value="{{ old('display_order', $province->display_order) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>

                        <div class="flex items-center gap-6 pt-2 md:pt-8">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="is_trending" value="1" {{ $province->is_trending ? 'checked' : '' }}
                                    class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-amber-500 focus:ring-amber-500 transition-all">
                                <span class="text-sm font-bold text-gray-600 dark:text-gray-300 group-hover:text-amber-500 transition-colors">⭐ پرطرفدار</span>
                            </label>

                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="is_active" value="1" {{ $province->is_active ? 'checked' : '' }}
                                    class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-green-500 focus:ring-green-500 transition-all">
                                <span class="text-sm font-bold text-gray-600 dark:text-gray-300 group-hover:text-green-500 transition-colors">✅ فعال</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: Descriptions -->
                <div class="border-b border-gray-100 dark:border-gray-700 py-8">
                    <h3 class="text-lg font-black text-gray-800 dark:text-white mb-6">توضیحات</h3>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">توضیحات (دری) *</label>
                            <textarea name="description" rows="5"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                                required>{{ old('description', $province->description) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English Description <span class="text-gray-400 text-xs">(اختیاری)</span></label>
                            <textarea name="description_en" rows="5"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 text-left transition-all"
                                dir="ltr" placeholder="English description...">{{ old('description_en', $province->description_en) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: Media -->
                <div class="border-b border-gray-100 dark:border-gray-700 py-8">
                    <h3 class="text-lg font-black text-gray-800 dark:text-white mb-6">تصاویر و گالری</h3>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- FEATURED IMAGE -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">تصویر شاخص</label>
                            <div class="flex items-start gap-4">
                                <div class="w-32 h-32 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center overflow-hidden flex-shrink-0 border-2 border-gray-200 dark:border-gray-600">
                                    @if ($province->featured_image)
                                        <img id="featuredPreview" src="{{ asset('storage/' . $province->featured_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <img id="featuredPreview" src="#" class="hidden w-full h-full object-cover">
                                        <i id="featuredPlaceholder" class="fas fa-image text-3xl text-gray-400"></i>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <label for="featured_image" class="block border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-4 text-center hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-gray-700 transition-all cursor-pointer bg-gray-50 dark:bg-gray-700/50">
                                        <i class="fas fa-cloud-upload-alt text-xl text-blue-500 mb-2"></i>
                                        <p class="text-sm font-bold text-gray-600 dark:text-gray-300">تصویر جدید (اختیاری)</p>
                                        <p class="text-xs text-gray-400 mt-1">JPG, PNG - Max 2MB</p>
                                    </label>
                                    <input type="file" name="featured_image" id="featured_image" class="hidden" accept="image/*"
                                        onchange="previewImage(this, 'featuredPreview', 'featuredPlaceholder')">
                                </div>
                            </div>
                        </div>

                        <!-- GALLERY IMAGES -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">گالری تصاویر</label>
                            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-4 hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-gray-700 transition-all cursor-pointer bg-gray-50 dark:bg-gray-700/50">
                                <label for="gallery_images" class="cursor-pointer block text-center w-full h-full">
                                    <i class="fas fa-images text-2xl text-blue-500 mb-2"></i>
                                    <p class="text-sm font-bold text-gray-600 dark:text-gray-300">افزودن عکس جدید</p>
                                </label>
                                <input type="file" name="gallery_images[]" id="gallery_images" class="hidden" accept="image/*"
                                    multiple onchange="previewGallery()">
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Preview Container -->
                    <div id="galleryPreview" class="grid grid-cols-4 md:grid-cols-6 gap-3 mt-4"></div>

                    <!-- Existing Gallery Images -->
                    @if ($province->gallery_images && count(json_decode($province->gallery_images)) > 0)
                        <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700/50">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">تصاویر فعلی گالری:</p>
                            <div class="grid grid-cols-4 md:grid-cols-6 gap-3">
                                @foreach (json_decode($province->gallery_images) as $image)
                                    <div class="relative group rounded-lg overflow-hidden border border-gray-200 dark:border-gray-600">
                                        <img src="{{ asset('storage/' . $image) }}" class="w-full h-24 object-cover">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- SECTION 4: Additional Details -->
                <div class="py-8">
                    <h3 class="text-lg font-black text-gray-800 dark:text-white mb-6">جزئیات تکمیلی</h3>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">تاریخچه</label>
                            <textarea name="history" rows="3"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">{{ old('history', $province->history) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">فرهنگ و رسوم</label>
                            <textarea name="culture" rows="3"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">{{ old('culture', $province->culture) }}</textarea>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">بهترین زمان بازدید</label>
                            <input type="text" name="best_time_to_visit" value="{{ old('best_time_to_visit', $province->best_time_to_visit) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">غذاهای محلی</label>
                            <input type="text" name="local_food" value="{{ old('local_food', $province->local_food) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">حمل و نقل</label>
                            <input type="text" name="transportation_info" value="{{ old('transportation_info', $province->transportation_info) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>
                    </div>
                </div>
            </form>

            <!-- ACTIONS BOTTOM BAR -->
            <div class="flex flex-col-reverse md:flex-row items-center justify-between gap-4 mt-4 pt-6 border-t border-gray-100 dark:border-gray-700">

                <!-- DELETE FORM (Left aligned) -->
                <form action="{{ route('admin.provinces.destroy', $province) }}" method="POST" onsubmit="return confirm('آیا از حذف این ولایت مطمئن هستید؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 px-4 py-3 rounded-xl font-bold text-sm transition-all flex items-center gap-2">
                        <i class="fas fa-trash"></i> حذف این ولایت
                    </button>
                </form>

                <!-- SAVE & CANCEL (Right aligned) -->
                <div class="flex items-center gap-3 w-full md:w-auto justify-end">
                    <a href="{{ route('admin.provinces.index') }}"
                        class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-6 py-3 rounded-xl font-bold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <i class="fas fa-times ms-1"></i> انصراف
                    </a>
                    <button type="submit" form="updateForm"
                        class="bg-blue-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-600 shadow-lg shadow-blue-500/30 transition-all">
                        <i class="fas fa-save ms-1"></i> بروزرسانی
                    </button>
                </div>

            </div>

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
                    div.className = 'relative group rounded-lg overflow-hidden border border-gray-200 dark:border-gray-600';
                    div.innerHTML =
                        `<img src="${e.target.result}" class="w-full h-24 object-cover">
                         <div class="absolute inset-0 bg-black/40 hidden group-hover:flex items-center justify-center transition-all">
                             <span class="text-white text-xs font-bold">جدید</span>
                         </div>`;
                    container.appendChild(div);
                };
                reader.readAsDataURL(files[i]);
            }
        }
    </script>

@endsection
