@extends('layouts.admin')

@section('title', 'افزودن هوتل جدید')
@section('page_title', 'افزودن هوتل جدید')
@section('page_subtitle', 'اطلاعات هوتل را وارد کنید')

@section('content')

    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-8">
            <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-8">
                    <h3
                        class="text-lg font-black text-gray-800 dark:text-white mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                        📋 اطلاعات اصلی</h3>

                    <div class="grid md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">مالک هوتل *</label>
                            <select name="user_id"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                                <option value="">-- انتخاب مالک --</option>
                                @foreach ($owners as $owner)
                                    <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ولایت *</label>
                            <select name="province_id"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                                <option value="">-- انتخاب ولایت --</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">مکان نزدیک <span
                                    class="text-gray-400 text-xs">(اختیاری)</span></label>
                            <select name="destination_id"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">-- انتخاب مکان--</option>
                                @foreach ($destinations as $dest)
                                    <option value="{{ $dest->id }}">{{ $dest->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">نام هوتل (دری)
                                *</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="مثال: هوتل کابل سرینا" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English Name <span
                                    class="text-gray-400 text-xs">(اختیاری)</span></label>
                            <input type="text" name="name_en" value="{{ old('name_en') }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                                dir="ltr" placeholder="Kabul Serena Hotel">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">شماره تماس
                                *</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                                dir="ltr" placeholder="+93 700 000 000" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">شماره واتساپ
                                *</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp') }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 text-left"
                                dir="ltr" placeholder="+93 700 000 000" required>
                            <p class="text-xs text-gray-400 mt-1">گردشگران از این شماره برای رزرو استفاده می‌کنند</p>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ایمیل <span
                                    class="text-gray-400 text-xs">(اختیاری)</span></label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                                dir="ltr" placeholder="info@hotel.com">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">وب‌سایت <span
                                    class="text-gray-400 text-xs">(اختیاری)</span></label>
                            <input type="text" name="website" value="{{ old('website') }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                                dir="ltr" placeholder="www.hotel.com">
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <h3
                        class="text-lg font-black text-gray-800 dark:text-white mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                        📍 موقعیت و زمان‌بندی</h3>
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">آدرس کامل *</label>
                        <textarea name="address" rows="2"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="کابل، منطقه وزیر اکبر خان، خیابان ۱۵" required>{{ old('address') }}</textarea>
                    </div>
                    <div class="grid md:grid-cols-4 gap-6">
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ساعت ورود
                                *</label><input type="time" name="check_in_time" value="14:00"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required></div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ساعت خروج
                                *</label><input type="time" name="check_out_time" value="12:00"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required></div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">فاصله از مرکز شهر
                                <span class="text-gray-400 text-xs">(اختیاری)</span></label>
                            <div class="relative">
                                <input type="number" step="0.1" name="distance_from_city_center"
                                    value="{{ old('distance_from_city_center') }}"
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="۵">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">km</span>
                            </div>
                        </div>
                        <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ترتیب
                                نمایش</label><input type="number" name="display_order"
                                value="{{ old('display_order', 0) }}"
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <h3
                        class="text-lg font-black text-gray-800 dark:text-white mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                        📝 جزئیات</h3>
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">توضیحات هوتل (دری)
                            *</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="امکانات، خدمات و ویژگی‌های هوتل..." required>{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English Description
                            <span class="text-gray-400 text-xs">(اختیاری)</span></label>
                        <textarea name="description_en" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                            dir="ltr" placeholder="Hotel facilities and services...">{{ old('description_en') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">زبان‌های پشتیبانی
                            <span class="text-gray-400 text-xs">(اختیاری)</span></label>
                        <input type="text" name="languages_spoken" value="{{ old('languages_spoken') }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="دری، پشتو، انگلیسی">
                    </div>
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
                                    <p class="text-sm font-bold text-gray-600 dark:text-gray-300">کلیک کنید و تصویر را
                                        انتخاب کنید</p>
                                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP - حداکثر ۲ مگابایت</p>
                                </label>
                                <input type="file" name="featured_image" id="featured_image" class="hidden"
                                    accept="image/*"
                                    onchange="previewImage(this, 'featuredPreview', 'featuredPlaceholder')" required>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">گالری تصاویر <span
                                class="text-gray-400 text-xs">(اختیاری)</span></label>
                        <div
                            class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-4 hover:border-blue-400 cursor-pointer bg-gray-50 dark:bg-gray-700 transition-all">
                            <label for="gallery_images" class="cursor-pointer block text-center">
                                <i class="fas fa-images text-3xl text-blue-500 mb-2"></i>
                                <p class="text-sm font-bold text-gray-600 dark:text-gray-300">انتخاب چند عکس برای گالری</p>
                            </label>
                            <input type="file" name="gallery_images[]" id="gallery_images" class="hidden"
                                accept="image/*" multiple onchange="previewGallery()">
                        </div>
                        <div id="galleryPreview" class="grid grid-cols-4 gap-3 mt-3"></div>
                    </div>
                </div>

                <div class="flex gap-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_approved" value="1" checked
                            class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-green-500">
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-300">✅ تایید شده</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked
                            class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-green-500">
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-300">✅ فعال</span>
                    </label>
                </div>

                <div class="flex gap-3 mt-8">
                    <button type="submit"
                        class="flex-1 bg-blue-500 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-600 hover:shadow-lg transition-all">
                        <i class="fas fa-save ms-1"></i> ذخیره هوتل
                    </button>
                    <a href="{{ route('admin.hotels.index') }}"
                        class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-8 py-4 rounded-xl font-bold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors flex items-center">
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
                    div.className = 'relative';
                    div.innerHTML =
                        `<img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg border border-gray-200"><span class="absolute top-1 right-1 bg-blue-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">${i+1}</span>`;
                    container.appendChild(div);
                };
                reader.readAsDataURL(files[i]);
            }
        }
    </script>

@endsection
