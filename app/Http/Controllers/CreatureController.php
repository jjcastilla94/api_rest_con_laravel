<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Creature;
use Illuminate\Http\Request;

class CreatureController extends Controller
{
    public function index() {
        return Creature::with('region')->get();
    }

    public function show($id) {
        return Creature::with('region')->findOrFail($id);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'species' => 'required',
            'threat_level' => 'required|integer|min:1|max:10',
            'region_id' => 'required|exists:regions,id'
        ]);

        return Creature::create($request->all());
    }

    public function update(Request $request, $id) {
        $creature = Creature::findOrFail($id);
        $creature->update($request->all());
        return $creature;
    }

    public function destroy($id) {
        Creature::destroy($id);
        return response()->json(['message' => 'Criatura eliminada']);
    }

    // Endpoint opcional
    public function dangerous(Request $request) {
        $level = $request->get('level', 8);

        return Creature::where('threat_level', '>=', $level)->get();
    }
}
