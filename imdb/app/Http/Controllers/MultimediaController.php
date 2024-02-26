<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use App\Models\Type;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');

        $multimedia = Multimedia::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder
                ->where(function ($innerQueryBuilder) use ($query) {
                    $innerQueryBuilder->where('title', 'like', '%' . $query . '%')
                        ->orWhere('year', 'like', '%' . $query . '%')
                        ->orWhere('language', 'like', '%' . $query . '%');
                });
        })->orderBy($sort, $order)
        ->paginate(15);

        return view('back-office.admin', [
            'multimedia' => $multimedia,
            'person' => null,
            'genre'=>null,
            'type'=>null,
            'user'=>null,
            'contact'=>null,
        ], ["multimedia"=> $multimedia, "query" => $query,'sort' => $sort, 'order' => $order]);
    }

    public function delete(Request $request, $id)
    {
        $multimedia = Multimedia::findOrFail($id);
        
        $multimedia->delete();

        return redirect()->route('admin.multimedia')->with('success', 'Multimedia deleted successfully');
    }

    public function edit($id)
    {
        $multimedia = Multimedia::findOrFail($id);
        return view('back-office.multimedia.edit', compact('multimedia'));
    }

    public function update(Request $request, $id)
    {
        $multimedia = Multimedia::findOrFail($id);
        $multimedia->update($request->all());
        return redirect()->route('admin.multimedia')->with('success', 'Multimedia updated successfully');
    }

    public function create()
    {
        $types = Type::all();
        return view('back-office.multimedia.create', compact('types'));
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'released' => 'required|string',
            'runtime' => 'required|string',
            'plot' => 'required|string',
            'language' => 'required|string',
            'country' => 'required|string',
            'awards' => 'required|string',
            'box_office' => 'required|string',
            'type_id' => 'required|integer',
            'metascore' => 'required|string',
            'imdb_rating' => 'required|string',
            'imdb_votes' => 'required|string',
        ]);

        // Cria uma nova instância de Multimedia e atribui os valores
        $multimedia = new Multimedia();
        $multimedia->title = $request->title;
        $multimedia->year = $request->year;
        $multimedia->released = $request->released;
        $multimedia->runtime = $request->runtime;
        $multimedia->plot = $request->plot;
        $multimedia->language = $request->language;
        $multimedia->country = $request->country;
        $multimedia->awards = $request->awards;
        $multimedia->box_office = $request->box_office;
        $multimedia->type_id = $request->type_id;
        $multimedia->metascore = $request->metascore;
        $multimedia->imdb_rating = $request->imdb_rating;
        $multimedia->imdb_votes = $request->imdb_votes;

        // Salva o novo objeto multimídia no banco de dados
        $multimedia->save();

        // Redireciona de volta com uma mensagem de sucesso
        return redirect()->route('admin.multimedia')->with('success', 'Multimedia created successfully');
    }


}
