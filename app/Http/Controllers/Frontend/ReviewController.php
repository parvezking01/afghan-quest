<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reviewable_type' => 'required|string',
            'reviewable_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Check if user already reviewed this item
        $existingReview = Review::where('user_id', auth()->id())
            ->where('reviewable_type', $request->reviewable_type)
            ->where('reviewable_id', $request->reviewable_id)
            ->first();

        if ($existingReview) {
            return back()->with('error', '❌ شما قبلاً نظر خود را ثبت کرده‌اید.');
        }

        Review::create([
            'user_id' => auth()->id(),
            'reviewable_type' => $request->reviewable_type,
            'reviewable_id' => $request->reviewable_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => true,
            'is_active' => true,
        ]);

        return back()->with('success', '✅ نظر شما با موفقیت ثبت شد.');
    }
}
