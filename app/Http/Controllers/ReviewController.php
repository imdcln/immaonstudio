<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:200',
        ]);

        Review::updateOrCreate(
            ['user_id' => Auth::id()], // ensures each user has only 1 review
            [
                'rating' => $request->rating,
                'review' => $request->review,
            ]
        );

        session()->flash('success', 'Review submitted successfully!');

        return response()->json([
            'success' => true,
        ]);
    }
}
