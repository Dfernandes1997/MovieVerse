<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');

        $user = User::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder
                ->where(function ($innerQueryBuilder) use ($query) {
                    $innerQueryBuilder->where('username', 'like', '%' . $query . '%')
                        ->orWhere('name', 'like', '%' . $query . '%')
                        ->orWhere('email', 'like', '%' . $query . '%');
                });
        })->orderBy($sort, $order)
        ->paginate(15);

        return view('back-office.admin', [
            'user'=> $user,
            'person' => null,
            'multimedia' => null,
            'genre'=>null,
            'type'=>null,
        ], ["user"=> $user, "query" => $query,'sort' => $sort, 'order' => $order]);
    }

    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('back-office.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }
}
