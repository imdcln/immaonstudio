<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactMail;
use App\Models\Classroom;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'required',
            'class' => 'required',
            'message' => 'required|string',
        ]);

        $class = Classroom::find($validated['class']);
        $senderEmail = Auth::check() ? Auth::user()->email : 'anonymous_immaonstudio@gmail.com';

        $validated['class'] = $class ? $class->class : 'Unknown';

        $validated['phone'] = $this->formatPhoneNumber($validated['phone']);

        $validated['logo_url'] = asset('images/ImmaOnStudio Logo.png');

        Mail::to('immaonstudio@gmail.com')->send((new ContactMail($validated))->from($senderEmail));

        return back()->with('success', 'Your message has been sent successfully!');
    }

    private function formatPhoneNumber($number)
    {
        $number = preg_replace('/\D/', '', $number);

        if (str_starts_with($number, '0')) {
            $number = substr($number, 1);
        }

        $formatted = '+62 ';

        $first = substr($number, 0, 3); // e.g. 813
        $rest = substr($number, 3);

        $formatted .= $first;

        $chunks = str_split($rest, 4);
        foreach ($chunks as $chunk) {
            $formatted .= '-' . $chunk;
        }

        return $formatted;
    }
}
