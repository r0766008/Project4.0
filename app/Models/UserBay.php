<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBay extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'bay_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id')->withDefault();
    }

    public function bay()
    {
        return $this->belongsTo('App\Models\Bay', 'bay_id')->withDefault();
    }
}
