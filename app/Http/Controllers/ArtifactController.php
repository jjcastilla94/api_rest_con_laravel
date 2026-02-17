<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Artifact;
use Illuminate\Http\Request;

class ArtifactController extends Controller
{
    public function index() {
        return Artifact::with('originRealm')->get();
    }

    public function show($id) {
        return Artifact::with(['originRealm', 'heroes'])->findOrFail($id);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'origin_realm_id' => 'required|exists:realms,id',
            'power_level' => 'required|integer|min:1|max:100'
        ]);

        return Artifact::create($request->all());
    }

    public function update(Request $request, $id) {
        $artifact = Artifact::findOrFail($id);
        $artifact->update($request->all());
        return $artifact;
    }

    public function destroy($id) {
        Artifact::findOrFail($id)->heroes()->detach(); // Desvincula los héroes asociados
        Artifact::destroy($id);
        return response()->json(['message' => 'Artefacto eliminado']);
    }

    // Endpoint opcional
    public function top() {
        return Artifact::where('power_level', '>', 90)->get();
    }
}
