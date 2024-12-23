<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('dashboard'); // Muestra la vista 'dashboard' para ambos roles
    }
}
