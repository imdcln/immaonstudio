<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ViewController extends Controller
{
    public function landing()
    {
        return view('landing');
    }

    public function about()
    {
        return view('about');
    }
    
    public function contact()
    {
        $classes = Classroom::orderBy('class')->pluck('class', 'id');

        return view('contact', compact('classes'));
    }

    public function reviews() {
        $reviews = Review::with('user')
            ->orderByRaw(Auth::check()
                ? "CASE WHEN user_id = " . Auth::id() . " THEN 0 ELSE 1 END"
                : "1"
            )
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $allReviews = Review::with('user')
            ->orderByDesc('created_at')
            ->get();

        return view('reviews', compact('reviews', 'allReviews'));
    }

    public function home()
    {
        return view('user.home');
    }

    public function reserve()
    {
        return view('user.reserve');
    }

    public function reserveList()
    {
        return view('user.reserveList');
    }
}
