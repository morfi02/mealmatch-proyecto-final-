<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dish;

class UsuariosController extends Controller
{
    public function clienteDashboard()
    {
        return view('cliente.dashboard');
    }

    public function cocineroDashboard()
    {
        $dishes = Auth::user()->dishes;
        return view('cocinero.dashboard', compact('dishes'));
    }
}
