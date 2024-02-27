<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller {
  public function send(Request $request) {
    $validated = $request->validate([
      'name' => 'required',
      'email' => 'required|email',
      'subject' => 'required',
      'message' => 'required',
      'g-recaptcha-response' => 'required|captcha'
    ]);

    $validated['subject'] = 'Mensaje de contacto de Citrogambas con asunto: ' . $validated['subject'];

    Mail::to('20610255@utgz.edu.mx')->send(new Contact($validated));

    return redirect('/contact')->with('success', 'Mensaje enviado satisfactoriamente.');
  }
}
