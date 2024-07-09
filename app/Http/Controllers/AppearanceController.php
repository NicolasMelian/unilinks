<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Links;
use App\Models\Appearance;
use Inertia\Inertia;

class AppearanceController extends Controller
{
    public function index()
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            // Redirige al login o muestra un error adecuado
            return redirect()->route('login')->withErrors('You must be logged in to access this page.');
        }

        // Obtén el usuario autenticado
        $user = Auth::user();
        $appearance = $user->appearance;

        // Verifica si el usuario tiene una apariencia
        if (!$appearance) {
            // Muestra un error adecuado o redirige
            return redirect()->route('some.route')->withErrors('Appearance not found for the user.');
        }

        // Obtén los enlaces del usuario
        $links = $user->links;

        return Inertia::render('Appearance', [
            'appearance' => $appearance,
            'links' => $links,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|unique:appearances,slug',
            'profile_image' => 'nullable|image',
            'profile_title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'theme' => 'nullable|string|in:theme1,theme2,theme3',
        ]);

        $appearanceData = $request->only(['slug', 'profile_title', 'bio', 'theme']);

        if ($request->hasFile('profile_image')) {
            $filename = Str::random(40) . '.' . $request->file('profile_image')->getClientOriginalExtension();
            $path = $request->file('profile_image')->storeAs('images', $filename, 'public');
            $appearanceData['profile_image'] = 'storage/' . $path;
        }

        $user = Auth::user();
        if ($user->appearance) {
            $user->appearance->update($appearanceData);
        } else {
            $appearanceData['user_id'] = $user->id;
            Appearance::create($appearanceData);
        }

        return redirect()->back()->with('success', 'Appearance saved successfully');
    }

    public function update(Request $request, Appearance $appearance)
    {
        $request->validate([
            'slug' => 'nullable|string|unique:appearances,slug,' . $appearance->id,
            'profile_image' => 'nullable|image',
            'profile_title' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'theme' => 'nullable|string|in:theme1,theme2,theme3',
        ]);

        $appearanceData = $request->only(['slug', 'profile_title', 'bio', 'theme']);

        if ($request->hasFile('profile_image')) {
            if ($appearance->profile_image && file_exists(public_path($appearance->profile_image))) {
                unlink(public_path($appearance->profile_image));
            }

            $filename = Str::random(40) . '.' . $request->file('profile_image')->getClientOriginalExtension();
            $path = $request->file('profile_image')->storeAs('images', $filename, 'public');
            $appearanceData['profile_image'] = 'storage/' . $path;
        }

        $appearance->update($appearanceData);

        return redirect()->back()->with('success', 'Appearance updated successfully');
    }
}
