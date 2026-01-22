<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegionController;
use App\Http\Controllers\RealmController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\CreatureController;
use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\ArtifactHeroController;


Route::apiResource('regions', RegionController::class);
Route::apiResource('realms', RealmController::class);
Route::apiResource('heroes', HeroController::class);
Route::apiResource('creatures', CreatureController::class);
Route::apiResource('artifacts', ArtifactController::class);


Route::post('artifact-hero', [ArtifactHeroController::class, 'store']);
Route::delete('artifact-hero', [ArtifactHeroController::class, 'destroy']);


Route::get('heroes/{id}/artifacts', function ($id) {
    return \App\Models\Hero::findOrFail($id)->artifacts;
});

Route::get('artifacts/{id}/heroes', function ($id) {
    return \App\Models\Artifact::findOrFail($id)->heroes;
});

Route::get('realms/{id}/heroes', function ($id) {
    return \App\Models\Realm::findOrFail($id)->heroes;
});

Route::get('regions/{id}/creatures', function ($id) {
    return \App\Models\Region::findOrFail($id)->creatures;
});

Route::get('heroes/alive', [HeroController::class, 'alive']);

Route::get('creatures/dangerous', [CreatureController::class, 'dangerous']);

Route::get('artifacts/top', [ArtifactController::class, 'top']);
