<div class="bg-white rounded-2xl p-6 shadow-sm mt-6">
    <h3 class="text-xl font-black text-gray-800 mb-6">⭐ نظرات و امتیازات</h3>

    <!-- Average Rating -->
    <div class="flex items-center gap-4 mb-6 bg-gray-50 rounded-xl p-4">
        <div class="text-center">
            <p class="text-4xl font-black text-gray-800">{{ number_format($reviewable->averageRating(), 1) }}</p>
            <div class="text-yellow-400 text-sm">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= round($reviewable->averageRating()))
                        <i class="fas fa-star"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor
            </div>
            <p class="text-xs text-gray-400 mt-1">{{ $reviewable->reviewsCount() }} نظر</p>
        </div>
    </div>

    <!-- Review Form -->
    @auth
        <form action="{{ route('reviews.store') }}" method="POST" class="mb-6 bg-gray-50 rounded-xl p-4">
            @csrf
            <input type="hidden" name="reviewable_type" value="{{ get_class($reviewable) }}">
            <input type="hidden" name="reviewable_id" value="{{ $reviewable->id }}">

            <div class="mb-3">
                <label class="block text-sm font-bold text-gray-700 mb-2">امتیاز شما *</label>
                <div class="flex gap-1 text-2xl star-container" style="direction: ltr; justify-content: flex-end;"
                    onmouseleave="resetStars(this)" data-selected="0">
                    <span class="star-item cursor-pointer text-gray-300" data-value="5" onclick="selectStar(this)"
                        onmouseenter="hoverStars(this)"><i class="fas fa-star"></i></span>
                    <span class="star-item cursor-pointer text-gray-300" data-value="4" onclick="selectStar(this)"
                        onmouseenter="hoverStars(this)"><i class="fas fa-star"></i></span>
                    <span class="star-item cursor-pointer text-gray-300" data-value="3" onclick="selectStar(this)"
                        onmouseenter="hoverStars(this)"><i class="fas fa-star"></i></span>
                    <span class="star-item cursor-pointer text-gray-300" data-value="2" onclick="selectStar(this)"
                        onmouseenter="hoverStars(this)"><i class="fas fa-star"></i></span>
                    <span class="star-item cursor-pointer text-gray-300" data-value="1" onclick="selectStar(this)"
                        onmouseenter="hoverStars(this)"><i class="fas fa-star"></i></span>
                </div>
                <input type="hidden" name="rating" id="ratingInput-{{ $reviewable->id }}" value="0" required>
            </div>

            <div class="mb-3">
                <textarea name="comment" rows="3"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="تجربه خود را بنویسید..." required></textarea>
            </div>

            <button type="submit"
                class="bg-blue-500 text-white px-6 py-2 rounded-xl font-bold hover:bg-blue-600 transition-colors">
                <i class="fas fa-paper-plane ms-1"></i> ثبت نظر
            </button>
        </form>
    @else
        <div class="bg-gray-50 rounded-xl p-4 text-center mb-6">
            <p class="text-gray-500">برای ثبت نظر <a href="{{ route('login') }}" class="text-blue-500 font-bold">وارد
                    شوید</a></p>
        </div>
    @endauth

    <!-- Reviews List -->
    <div class="space-y-4">
        @php $reviews = $reviewable->reviews()->where('is_approved', true)->latest()->take(10)->get(); @endphp
        @forelse($reviews as $review)
            <div class="flex gap-3 p-4 bg-gray-50 rounded-xl">
                <div
                    class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold flex-shrink-0">
                    {{ mb_substr($review->user->name, 0, 1) }}
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <p class="font-bold text-gray-700 text-sm">{{ $review->user->name }}</p>
                        <span class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="text-yellow-400 text-sm mb-1">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <p class="text-gray-600 text-sm">{{ $review->comment }}</p>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-400 py-4">هنوز نظری ثبت نشده است. اولین نفر باشید!</p>
        @endforelse
    </div>
</div>

<script>
    function hoverStars(element) {
        const container = element.parentElement;
        const value = parseInt(element.dataset.value);
        fillStars(container, value);
    }

    function selectStar(element) {
        const container = element.parentElement;
        const reviewableId = container.closest('form').querySelector('input[name="reviewable_id"]').value;
        const ratingInput = document.getElementById('ratingInput-' + reviewableId);
        const value = parseInt(element.dataset.value);

        ratingInput.value = value;
        container.dataset.selected = value;
        fillStars(container, value);
    }

    function resetStars(container) {
        const selected = parseInt(container.dataset.selected) || 0;
        fillStars(container, selected);
    }

    function fillStars(container, value) {
        const stars = container.querySelectorAll('.star-item');
        stars.forEach(star => {
            const starValue = parseInt(star.dataset.value);
            if (starValue <= value) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });
    }
</script>

<style>
    .star-item {
        transition: color 0.15s ease;
    }

    .star-item:hover {
        transform: scale(1.2);
        transition: transform 0.15s ease;
    }
</style>
