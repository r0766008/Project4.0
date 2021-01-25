<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'eta', 'ata', 'atd', 'truck_id', 'bay_id', 'schedule_status_id'];

    public function bay()
    {
        return $this->belongsTo('App\Models\Bay', 'bay_id')->withDefault();
    }

    public function truck()
    {
        return $this->belongsTo('App\Models\Truck', 'truck_id')->withDefault();
    }

    public function status()
    {
        return $this->belongsTo('App\Models\ScheduleStatus', 'schedule_status_id')->withDefault();
    }
}
