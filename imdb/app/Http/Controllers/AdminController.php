<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {
        return view('back-office.admin',[
            'multimedia'=>null,
            'person'=>null,
            'genre'=>null,
            'type'=>null,
            'user'=>null
        ]);
    }
}
