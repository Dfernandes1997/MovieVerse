<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Criar 4 registros de exemplo
        Contact::create([
            'name' => 'João Silva',
            'contacto' => 'joao@example.com',
            'titulo' => 'Dúvida sobre o produto',
            'mensagem' => 'Olá, tenho uma dúvida sobre o produto X. Poderiam me ajudar?',
            'read' => true,
        ]);

        Contact::create([
            'name' => 'Ana Oliveira',
            'contacto' => 'ana@example.com',
            'titulo' => 'Sugestão de melhoria',
            'mensagem' => 'Gostaria de sugerir uma melhoria no serviço de entrega. Como posso fazer?',
            'read' => false,
        ]);

        Contact::create([
            'name' => 'Pedro Santos',
            'contacto' => 'pedro@example.com',
            'titulo' => 'Problema com a fatura',
            'mensagem' => 'Estou com um problema na fatura do último pedido. Podem me ajudar a resolver?',
            'read' => true,
        ]);

        Contact::create([
            'name' => 'Marta Sousa',
            'contacto' => 'marta@example.com',
            'titulo' => 'Elogio ao atendimento',
            'mensagem' => 'Gostaria de elogiar o excelente atendimento que recebi no último contato. Parabéns!',
            'read' => false,
        ]);
    }
}
