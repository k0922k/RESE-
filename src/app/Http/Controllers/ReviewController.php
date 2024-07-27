<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, $reservation_id)
    {

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);


        $review = new Review;
        $review->reservation_id = $reservation_id;
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        $review->save();

        return redirect()->back()->with('success', 'レビューが保存されました');
    }
}
