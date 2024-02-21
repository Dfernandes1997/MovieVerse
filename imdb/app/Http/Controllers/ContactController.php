<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Método para exibir a view
    public function ContactForm()
    {
        return view('front-office.contact');
    }

    // Método para salvar a mensagem de contato
    public function saveContactMessage(Request $request)
    {
        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->contacto = $request->input('email');
        $contact->titulo = $request->input('subject');
        $contact->mensagem = $request->input('message');
        $contact->read = false; // Define a mensagem como não lida por padrão
        $contact->save();

        return redirect()->back()->with('success', 'Message Send to Support Team!');
    }
}
