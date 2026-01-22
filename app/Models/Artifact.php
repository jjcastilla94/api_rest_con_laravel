<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artifact extends Model{
    protected $fillable = [
        'name', 'type', 'origin_realm_id', 'power_level', 'description'
    ];

    public function originRealm(){
        return $this->belongsTo(Realm::class, 'origin_realm_id');
    }

    // Alias to keep backwards compatibility when accessing realm
    public function realm(){
        return $this->originRealm();
    }

    public function heroes(){
        return $this->belongsToMany(Hero::class);
    }
}