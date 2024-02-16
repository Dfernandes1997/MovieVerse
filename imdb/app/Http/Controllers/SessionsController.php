<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{

    public function create()
    {
        return view('login.login') ;
    }

    public function login()
    {
        //atributos introduzidos
        $attributes = request()->validate([
            'email' =>'required|email',
            'password'=> 'required'
        ]);

        // tentar autenticar consoante os atributos introduzidos
        if(auth()->attempt($attributes)){
            // Verificar se é admin ou não
            if (auth()->user()->is_admin == 1) {
                return redirect('admin')->with('success', 'Welcome back, Admin!');
            } else {
                return redirect('/')->with('success', 'Welcome back!');
            }
        }

        // caso os atributos não existam na base de dados
        throw ValidationException::withMessages(['email'=> 'Your provided credentials could not be verified.']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect("/")->with("success","Goodbye!");
    }

    // Método para lidar com o acesso não autorizado à página de WatchList
    public function redirectToStartStream()
    {
        // Redirecionar para a página inicial
        return redirect('/#start-stream')->with("success","You need an account to access the WatchList.");
    }

    // Método para lidar com o acesso não autorizado aos comentarios
    public function redirectToStart()
    {
        // Redirecionar para a página inicial
        return redirect('/#start-stream')->with("success","You need an account to Comment or Reply.");
    }
}
