<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BayStatus extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function bays()
    {
        return $this->hasMany('App\Models\Bay');
    }
}
