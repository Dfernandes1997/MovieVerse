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

    public function index(Request $request)
    {
        $contact = Contact::orderBy('read') // Ordena primeiro as mensagens não lidas
                            ->paginate(15);
    
        return view('back-office.admin', [
            'user' => null,
            'person' => null,
            'multimedia' => null,
            'genre' => null,
            'type' => null,
            'contact' => $contact,
        ]);
    }

    public function updateRead(Request $request)
    {
        $messageId = $request->input('messageId');
        
        // Encontre a mensagem pelo ID
        $message = Contact::find($messageId);
        
        // Verifique se a mensagem foi encontrada e se o status de leitura ainda não foi atualizado
        if ($message && $message->read == 0) {
            // Atualize o status de leitura para 1
            $message->read = 1;
            $message->save();
            
            // Retorne uma resposta JSON para indicar o sucesso
            return response()->json(['success' => true]);
        }
        
        // Se a mensagem não foi encontrada ou se o status de leitura já foi atualizado, retorne uma resposta JSON de erro
        return response()->json(['success' => false, 'message' => 'Message not found or already read.']);
    }

}
