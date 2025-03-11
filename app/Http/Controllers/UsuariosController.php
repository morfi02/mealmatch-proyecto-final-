<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Dish;

class UsuariosController extends Controller
{
    public function clienteDashboard()
    {
        $cocineros = User::where('rol', 'cocinero')
            ->with('dishes')
            ->get();

        return view('cliente.dashboard', compact('cocineros'));
    }

    public function cocineroDashboard()
    {
        $dishes = Auth::user()->dishes;
        return view('cocinero.dashboard', compact('dishes'));
    }
    public function showCocinero($id)
    {
        $cocinero = User::with('dishes')->findOrFail($id);
        return view('cliente.perfil-cocinero', compact('cocinero'));
    }
    public function show($id)
    {
        $cocinero = User::findOrFail($id);
        return view('cliente.perfil-cocinero', compact('cocinero'));
    }
    
}
