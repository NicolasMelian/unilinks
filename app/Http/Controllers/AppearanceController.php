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
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->withErrors('You must be logged in to access this page.');
        }
    
        $appearance = $user->appearance;
    
        // Si el usuario no tiene una apariencia, crea una nueva
        if (!$appearance) {
            $appearance = Appearance::create([
                'user_id' => $user->id,
                'slug' => Str::random(40),
                'profile_title' => 'Default Title',  // Puedes personalizar estos valores por defecto
                'bio' => '',
                'theme' => 'theme1',
            ]);
        }
    
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
            'theme' => 'nullable|string|in:theme1,theme2,theme3,custom', // Añadimos 'custom'
            'custom_background_image' => 'nullable|image', // Nueva validación
        ]);
    
        $appearanceData = $request->only(['slug', 'profile_title', 'bio', 'theme']);
    
        if ($request->hasFile('profile_image')) {
            $filename = Str::random(40) . '.' . $request->file('profile_image')->getClientOriginalExtension();
            $path = $request->file('profile_image')->storeAs('images', $filename, 'public');
            $appearanceData['profile_image'] = 'storage/' . $path;
        }
    
        if ($request->hasFile('custom_background_image')) {
            $filename = Str::random(40) . '.' . $request->file('custom_background_image')->getClientOriginalExtension();
            $path = $request->file('custom_background_image')->storeAs('images', $filename, 'public');
            $appearanceData['custom_background_image'] = 'storage/' . $path;
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
            'theme' => 'nullable|string|in:theme1,theme2,theme3,custom', // Añadimos 'custom'
            'custom_background_image' => 'nullable|image', // Nueva validación
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
    
        if ($request->hasFile('custom_background_image')) {
            if ($appearance->custom_background_image && file_exists(public_path($appearance->custom_background_image))) {
                unlink(public_path($appearance->custom_background_image));
            }
    
            $filename = Str::random(40) . '.' . $request->file('custom_background_image')->getClientOriginalExtension();
            $path = $request->file('custom_background_image')->storeAs('images', $filename, 'public');
            $appearanceData['custom_background_image'] = 'storage/' . $path;
        }
    
        $appearance->update($appearanceData);
    
        return redirect()->back()->with('success', 'Appearance updated successfully');
    }
    
}
