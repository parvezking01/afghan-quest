@extends('layouts.hotel-owner')

@section('title', 'افزودن هوتل جدید')
@section('page_title', 'افزودن هوتل جدید')
@section('page_subtitle', 'اطلاعات هوتل خود را وارد کنید')

@section('content')

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <form action="{{ route('hotel_owner.hotels.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">نام هوتل *</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="نام هوتل خود را وارد کنید" required>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">ولایت *</label>
                        <select name="province_id"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                            <option value="">-- انتخاب ولایت --</option>
                            @foreach (\App\Models\Province::where('is_active', true)->orderBy('name')->get() as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">شماره تماس *</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-left"
                            dir="ltr" placeholder="+93 700 000 000" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">شماره واتساپ *</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp') }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-left"
                            dir="ltr" placeholder="+93 700 000 000" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">ایمیل <span
                                class="text-gray-400 text-xs">(اختیاری)</span></label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="info@hotel.com">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">ساعت ورود *</label>
                        <input type="time" name="check_in_time" value="14:00"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">ساعت خروج *</label>
                        <input type="time" name="check_out_time" value="12:00"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">آدرس *</label>
                    <textarea name="address" rows="2"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="آدرس کامل هوتل" required>{{ old('address') }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">توضیحات *</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="امکانات و خدمات هوتل..." required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">تصویر شاخص *</label>
                    <div class="flex items-start gap-4">
                        <div
                            class="w-40 h-40 bg-gray-100 rounded-xl flex items-center justify-center overflow-hidden flex-shrink-0 border-2 border-gray-200">
                            <img id="featuredPreview" src="#" class="hidden w-full h-full object-cover"
                                style="display:none;">
                            <i id="featuredPlaceholder" class="fas fa-image text-4xl text-gray-400"></i>
                        </div>
                        <div class="flex-1">
                            <label for="featured_image"
                                class="block border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:border-blue-400 cursor-pointer bg-gray-50">
                                <i class="fas fa-cloud-upload-alt text-2xl text-blue-500 mb-2"></i>
                                <p class="text-sm font-bold text-gray-600">انتخاب تصویر</p>
                            </label>
                            <input type="file" name="featured_image" id="featured_image" class="hidden" accept="image/*"
                                onchange="previewImage(this, 'featuredPreview', 'featuredPlaceholder')" required>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 bg-blue-500 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-600 transition-all">
                        <i class="fas fa-save ms-1"></i> ذخیره هوتل
                    </button>
                    <a href="{{ route('hotel_owner.hotels.index') }}"
                        class="bg-gray-100 text-gray-600 px-8 py-4 rounded-xl font-bold hover:bg-gray-200 transition-colors">انصراف</a>
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
    </script>

@endsection
