<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class UserController extends Controller
{
    public function home() {
        $reviews = Review::with('user')
        ->latest()
        ->take(3)
        ->get();

        return view('user.home', compact('reviews'));
    }
}
