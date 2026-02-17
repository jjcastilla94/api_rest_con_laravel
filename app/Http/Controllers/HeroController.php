<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;

class HeroController extends Controller
{
    public function index() {
        return Hero::with('realm')->get();
    }

    public function show($id) {
        return Hero::with(['realm', 'artifacts'])->findOrFail($id);
    }

    public function store(Request $request) {
        return Hero::create($request->all());
    }

    public function update(Request $request, $id) {
        $hero = Hero::findOrFail($id);
        $hero->update($request->all());
        return $hero;
    }

    public function destroy($id) {
       Hero::findOrFail($id)->artifacts()->detach(); // Desvincula los artefactos asociados
        Hero::destroy($id);
        return response()->json(['message' => 'Héroe eliminado']);
    }

    // Endpoint adicional
    public function alive() {
        return Hero::where('alive', true)->get();
    }
}
