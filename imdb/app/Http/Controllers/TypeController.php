<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');

        $type = Type::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder
                ->where(function ($innerQueryBuilder) use ($query) {
                    $innerQueryBuilder->where('name', 'like', '%' . $query . '%');
                });
        })->orderBy($sort, $order)
        ->paginate(15);

        return view('back-office.admin', [
            'type'=>$type,
            'person' => null,
            'multimedia' => null,
            'genre'=>null,
            'user'=>null
        ], ["type"=> $type, "query" => $query,'sort' => $sort, 'order' => $order]);
    }

    public function delete(Request $request, $id)
    {
        $type = Type::findOrFail($id);
        
        $type->delete();

        return redirect()->route('admin.types')->with('success', 'Type deleted successfully');
    }

    public function edit($id)
    {
        $type = Type::findOrFail($id);
        return view('back-office.type.edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $type = Type::findOrFail($id);
        $type->update($request->all());
        return redirect()->route('admin.types')->with('success', 'Type updated successfully');
    }

    public function create()
    {
        return view('back-office.type.create');
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Cria uma nova instância e atribui os valores
        $type = new Type();
        $type->name = $request->name;

        // Salva o novo objeto no banco de dados
        $type->save();

        // Redireciona de volta com uma mensagem de sucesso
        return redirect()->route('admin.types')->with('success', 'Type created successfully');
    }
}
