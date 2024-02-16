<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');

        $person = Person::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder
                ->where(function ($innerQueryBuilder) use ($query) {
                    $innerQueryBuilder->where('name', 'like', '%' . $query . '%');
                });
        })->orderBy($sort, $order)
        ->paginate(15);

        return view('back-office.admin', [
            'person' => $person,
            'multimedia' => null,
            'genre'=>null,
            'type'=>null,
            'user'=>null
        ], ["person"=> $person, "query" => $query,'sort' => $sort, 'order' => $order]);
    }

    public function delete(Request $request, $id)
    {
        $person = Person::findOrFail($id);
        
        $person->delete();

        return redirect()->route('admin.persons')->with('success', 'Person deleted successfully');
    }

    public function edit($id)
    {
        $person = Person::findOrFail($id);
        return view('back-office.person.edit', compact('person'));
    }

    public function update(Request $request, $id)
    {
        $person = Person::findOrFail($id);
        $person->update($request->all());
        return redirect()->route('admin.persons')->with('success', 'Person updated successfully');
    }

    public function create()
    {
        return view('back-office.person.create');
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Cria uma nova instância e atribui os valores
        $person = new Person();
        $person->name = $request->name;

        // Salva o novo objeto no banco de dados
        $person->save();

        // Redireciona de volta com uma mensagem de sucesso
        return redirect()->route('admin.persons')->with('success', 'Person created successfully');
    }
}
