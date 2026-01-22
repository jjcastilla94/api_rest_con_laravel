<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;

class ArtifactHeroController extends Controller
{
    public function store(Request $request) {
        $hero = Hero::findOrFail($request->hero_id);
        $hero->artifacts()->attach($request->artifact_id);

        return response()->json(['message' => 'Artefacto asignado']);
    }

    public function destroy(Request $request) {
        $hero = Hero::findOrFail($request->hero_id);
        $hero->artifacts()->detach($request->artifact_id);

        return response()->json(['message' => 'Artefacto retirado']);
    }
}
