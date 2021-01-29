<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'eta', 'ata', 'atd', 'user_truck_id', 'bay_id', 'schedule_status_id'];

    public function bay()
    {
        return $this->belongsTo('App\Models\Bay', 'bay_id')->withDefault();
    }

    public function userTruck()
    {
        return $this->belongsTo('App\Models\UserTruck', 'user_truck_id')->withDefault();
    }

    public function truck()
    {
        return $this->userTruck()->with('truck');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\ScheduleStatus', 'schedule_status_id')->withDefault();
    }
}
