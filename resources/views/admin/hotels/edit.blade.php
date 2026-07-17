@extends('layouts.admin')

@section('title', 'ویرایش هوتل')
@section('page_title', 'ویرایش: ' . $hotel->name)
@section('page_subtitle', 'اطلاعات هوتل را بروزرسانی کنید')

@section('content')

    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-8">
            <form action="{{ route('admin.hotels.update', $hotel) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">مالک هوتل *</label>
                        <select name="user_id"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                            @foreach ($owners as $owner)
                                <option value="{{ $owner->id }}" {{ $hotel->user_id == $owner->id ? 'selected' : '' }}>
                                    {{ $owner->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ولایت *</label>
                        <select name="province_id"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}"
                                    {{ $hotel->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">مکان نزدیک</label>
                        <select name="destination_id"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- انتخاب مکان--</option>
                            @foreach ($destinations as $dest)
                                <option value="{{ $dest->id }}"
                                    {{ $hotel->destination_id == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">نام هوتل (دری)
                            *</label>
                        <input type="text" name="name" value="{{ old('name', $hotel->name) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English Name <span
                                class="text-gray-400 text-xs">(اختیاری)</span></label>
                        <input type="text" name="name_en" value="{{ old('name_en', $hotel->name_en) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                            dir="ltr">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">شماره تماس *</label>
                        <input type="text" name="phone" value="{{ old('phone', $hotel->phone) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                            dir="ltr" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">شماره واتساپ *</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $hotel->whatsapp) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 text-left"
                            dir="ltr" required>
                    </div>
                    <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ایمیل</label><input
                            type="email" name="email" value="{{ old('email', $hotel->email) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                            dir="ltr"></div>
                    <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">وب‌سایت</label><input
                            type="text" name="website" value="{{ old('website', $hotel->website) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                            dir="ltr"></div>
                    <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ساعت ورود
                            *</label><input type="time" name="check_in_time"
                            value="{{ old('check_in_time', $hotel->check_in_time) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required></div>
                    <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ساعت خروج
                            *</label><input type="time" name="check_out_time"
                            value="{{ old('check_out_time', $hotel->check_out_time) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required></div>
                    <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">زبان‌های
                            پشتیبانی</label><input type="text" name="languages_spoken"
                            value="{{ old('languages_spoken', $hotel->languages_spoken) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">فاصله از مرکز شهر
                            (km)</label><input type="number" step="0.1" name="distance_from_city_center"
                            value="{{ old('distance_from_city_center', $hotel->distance_from_city_center) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div><label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ترتیب
                            نمایش</label><input type="number" name="display_order"
                            value="{{ old('display_order', $hotel->display_order) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">آدرس *</label>
                    <textarea name="address" rows="2"
                        class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>{{ old('address', $hotel->address) }}</textarea>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">توضیحات (دری) *</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>{{ old('description', $hotel->description) }}</textarea>
                </div>
                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">English Description <span
                            class="text-gray-400 text-xs">(اختیاری)</span></label>
                    <textarea name="description_en" rows="4"
                        class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                        dir="ltr">{{ old('description_en', $hotel->description_en) }}</textarea>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">تصویر شاخص</label>
                    @if ($hotel->featured_image)
                        <div
                            class="mb-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-3 flex items-center gap-3">
                            <i class="fas fa-image text-amber-500"></i>
                            <span class="text-sm text-amber-700 dark:text-amber-400">تصویر فعلی موجود است.</span>
                        </div>
                    @endif
                    <div class="flex items-start gap-4">
                        <div
                            class="w-40 h-40 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center overflow-hidden flex-shrink-0 border-2 border-gray-200 dark:border-gray-600">
                            @if ($hotel->featured_image)
                                <img id="featuredPreview" src="{{ asset('storage/' . $hotel->featured_image) }}"
                                class="w-full h-full object-cover">@else<img id="featuredPreview" src="#"
                                    class="hidden w-full h-full object-cover" style="display:none;"><i
                                    id="featuredPlaceholder" class="fas fa-image text-4xl text-gray-400"></i>
                            @endif
                        </div>
                        <div class="flex-1">
                            <label for="featured_image"
                                class="block border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-4 text-center hover:border-blue-400 cursor-pointer bg-gray-50 dark:bg-gray-700">
                                <i class="fas fa-cloud-upload-alt text-2xl text-blue-500 mb-2"></i>
                                <p class="text-sm font-bold text-gray-600 dark:text-gray-300">تصویر جدید (اختیاری)</p>
                            </label>
                            <input type="file" name="featured_image" id="featured_image" class="hidden"
                                accept="image/*" onchange="previewImage(this, 'featuredPreview', 'featuredPlaceholder')">
                        </div>
                    </div>
                </div>

                <div class="flex gap-6 mt-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4">
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" name="is_approved"
                            value="1" {{ $hotel->is_approved ? 'checked' : '' }} class="w-5 h-5 rounded"><span
                            class="text-sm font-bold text-gray-700 dark:text-gray-300">✅ تایید شده</span></label>
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" name="is_active"
                            value="1" {{ $hotel->is_active ? 'checked' : '' }} class="w-5 h-5 rounded"><span
                            class="text-sm font-bold text-gray-700 dark:text-gray-300">✅ فعال</span></label>
                </div>

                <div class="flex gap-3 mt-8">
                    <button type="submit"
                        class="bg-blue-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-600 transition-colors"><i
                            class="fas fa-save ms-1"></i> بروزرسانی</button>
                    <a href="{{ route('admin.hotels.index') }}"
                        class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-8 py-3 rounded-xl font-bold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">انصراف</a>
                </div>
            </form>

            <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST"
                class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                @csrf @method('DELETE')
                <button type="button" onclick="confirmDelete(this.parentElement)"
                    class="text-red-500 hover:text-red-700 font-bold text-sm"><i class="fas fa-trash ms-1"></i> حذف این
                    هوتل</button>
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
                    if (placeholderId) {
                        const placeholder = document.getElementById(placeholderId);
                        if (placeholder) placeholder.style.display = 'none';
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
