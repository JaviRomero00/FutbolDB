<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{

public function team()
{
    return $this->belongsTo(Team::class);
}

public function league()
{
    return $this->belongsTo(League::class);
}
}
