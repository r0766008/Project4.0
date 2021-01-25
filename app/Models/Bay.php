<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bay extends Model
{
    use HasFactory;
    protected $fillable = ['number', 'bay_status_id'];

    public function status()
    {
        return $this->belongsTo('App\Models\BayStatus', 'bay_status_id')->withDefault();
    }

    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule');
    }
}
