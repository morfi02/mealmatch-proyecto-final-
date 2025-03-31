<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'seller_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Evita múltiples valoraciones del mismo usuario
        Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'seller_id' => $request->seller_id,
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]
        );

        return back()->with('success', '¡Gracias por tu valoración!');
    }
}