<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index() {
        return Region::all();
    }

    public function show($id) {
        return Region::findOrFail($id);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required'
        ]);

        return Region::create($request->all());
    }

    public function update(Request $request, $id) {
        $region = Region::findOrFail($id);
        $region->update($request->all());
        return $region;
    }

    public function destroy($id) {
        Region::destroy($id);
        return response()->json(['message' => 'Región eliminada']);
    }
}
