<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realm;

class RealmController extends Controller
{
    public function index() {
        return Realm::with('region')->get();
    }

    public function show($id) {
        return Realm::with(['region', 'heroes', 'artifacts'])->findOrFail($id);
    }

    public function store(Request $request) {
        return Realm::create($request->all());
    }

    public function update(Request $request, $id) {
        $realm = Realm::findOrFail($id);
        $realm->update($request->all());
        return $realm;
    }

    public function destroy($id) {
        Realm::destroy($id);
        return response()->json(['message' => 'Reino eliminado']);
    }
}
