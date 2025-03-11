<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Auth::user()->dishes;
        return view('cocinero.dashboard', compact('dishes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('dishes', 'public');

        Dish::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('cocinero.dashboard');
    }
    public function edit(Dish $dish)
    {
        return view('cocinero.edit-dish', compact('dish'));
    }

    public function update(Request $request, Dish $dish)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->price = $request->price;

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $dish->image);
            $path = $request->file('image')->store('dishes', 'public');
            $dish->image = $path;
        }

        $dish->save();

        return redirect()->route('cocinero.dashboard')->with('success', 'Plato actualizado exitosamente');
    }

    public function destroy(Dish $dish)
    {
        Storage::delete('public/' . $dish->image);
        $dish->delete();
        return redirect()->route('cocinero.dashboard')->with('success', 'Plato eliminado exitosamente');
    }
}