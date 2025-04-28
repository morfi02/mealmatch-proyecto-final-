<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Dish;
use App\Models\Order;

class UsuariosController extends Controller
{
    public function clienteDashboard()
    {
        $cocineros = User::where('rol', 'cocinero')
            ->with('dishes')
            ->get();

        $categorias = Dish::select('tags')->get()->pluck('tags')->flatten()->unique();

        return view('cliente.dashboard', compact('cocineros','categorias'));
    }

    public function cocineroDashboard()
    {
        $dishes = Auth::user()->dishes;
        $ratings = Auth::user()->ratingsReceived()->with('user')->latest()->get();

        $averageRating = $ratings->avg('rating'); 
        $totalComments = $ratings->whereNotNull('comment')->count(); 

        return view('cocinero.dashboard', compact('dishes','ratings','averageRating', 'totalComments'));
    }
    public function showCocinero($id)
    {
        $cocinero = User::with('dishes')->findOrFail($id);

        $order = Order::where('user_id', auth()->id())
            ->where('cocinero_id', $id)
            ->first();

        return view('cliente.perfil-cocinero', compact('cocinero', 'order'));
    }
    public function show($id)
    {
        $cocinero = User::findOrFail($id);

        $order = Order::where('user_id', auth()->id())
        ->where('cocinero_id', $id)
        ->first(); 
        return view('cliente.perfil-cocinero', compact('cocinero', 'order'));
    }

    public function buscarCocineros(Request $request)
    {
        $query = User::where('rol', 'cocinero')->with('dishes');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('categoria')) {
            $query->whereHas('dishes', function ($q) use ($request) {
                $q->whereJsonContains('tags', $request->categoria);
            });
        }

        $cocineros = $query->get();

        // Obtener todas las categorías únicas de la columna 'tags'
        $categorias = Dish::select('tags')->get()->pluck('tags')->flatten()->unique();

        return view('cliente.dashboard', compact('cocineros', 'categorias'));
    }

    
}
