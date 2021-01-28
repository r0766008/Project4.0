<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTruck extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'truck_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id')->withDefault();
    }

    public function truck()
    {
        return $this->belongsTo('App\Models\Truck', 'truck_id')->withDefault();
    }
}
