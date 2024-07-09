<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class LinkController extends Controller
{
    public function index(){
        if (Auth::check()) {
            // Obtén los enlaces solo del usuario autenticado
            $links = Auth::user()->links;
        } else {
            // Opcional: Maneja el caso donde el usuario no está autenticado
            // Puedes decidir redirigir al usuario a la página de inicio de sesión
            // o simplemente enviar un arreglo vacío.
            $links = collect(); // Retorna una colección vacía
        }

        return Inertia::render('Links', [
            'links' => $links->map(function ($link) {
                return [
                    'id' => $link->id,
                    'name' => $link->name,
                    'url' => $link->url,
                    'image' => $link->image ? url('/' . $link->image) : null, // Usa url() para generar la URL completa
                ];
            }),
        ]);
        
}

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'image' => 'nullable|image'
        ]);

        $link = new Link($request->only(['name', 'url', 'image']));
        
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->move(public_path('images'), $filename);
            $link->image = 'images/' . $filename;
        }
        
        

        $link->user_id = Auth::id();

        $link->save();

        return redirect()->back();
    }

    public function update(Request $request, Link $link){
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'image' => 'nullable|image'
        ]);
    
        $link->update($request->only(['name', 'url']));       
    
        if ($request->hasFile('image')) {
            // Elimina la imagen anterior si existe
            if ($link->image && file_exists(public_path($link->image))) {
                unlink(public_path($link->image));
            }
    
            // Genera un nombre de archivo único
            $filename = Str::random(40) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $filename);
            $link->image = 'images/' . $filename;
            $link->save(); // Asegúrate de guardar el enlace después de actualizar la imagen
        }
    
        return redirect()->back()->with('success', 'Link updated successfully');
    }
    

    public function destroy(Link $link)
    {
        $link->delete();
        return redirect()->back();
    }
}
