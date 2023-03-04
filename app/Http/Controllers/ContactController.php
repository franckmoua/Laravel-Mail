<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
{

    return view('contactForm');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email',
        'message' => 'required|min:15',
    ]);

    $message = new Contact([
        'message' => $validated['message'],
        'token' => Str::random(32),
        'email' => $validated['email']
    ]);

    $message->save();

    Mail::to($validated['email'])->send(new ContactMail($message));

    return redirect()->route('contact.create')->with('success', 'Message sent successfully!');
}

public function show($token)
{
    $message = Contact::where('token', $token)->firstOrFail();

    $message->delete();

    return view('secret-page', ['message' => $message]);
}
}