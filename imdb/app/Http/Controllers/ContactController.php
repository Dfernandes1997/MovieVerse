<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Método para exibir a view
    public function ContactForm()
    {
        return view('front-office.contact');
    }
}
