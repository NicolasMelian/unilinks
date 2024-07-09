<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appearance;
use App\Models\Links;
use App\Models\User;
use Inertia\Inertia;

class LandingController extends Controller
{
    public function show($slug)
    {
        $appearance = Appearance::where('slug', $slug)->firstOrFail();
        $links = $appearance->user->links;

        return Inertia::render('Landing', [
            'appearance' => $appearance,
            'links' => $links,
            'user' => [
                'id' => $appearance->user->id,
                'name' => $appearance->user->name,
                'email' => $appearance->user->email,
                'slug' => $appearance->slug, // Asegúrate de pasar el slug aquí
            ],
        ]);
    }
}
