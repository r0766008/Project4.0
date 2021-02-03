<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $currentDay = Carbon::now();
        $schedules = Schedule::select('schedules.id', 'date', 'eta', 'ata', 'atd', 'trucks.license_plate', 'trucks.rfid', 'trucks.company', 'bays.number', 'schedule_statuses.name')
            ->where('date', $currentDay->toDateString())
            ->join('user_trucks', 'user_trucks.id', '=', 'schedules.user_truck_id')
            ->join('trucks', 'trucks.id', '=', 'user_trucks.truck_id')
            ->join('bays', 'bays.id', '=', 'schedules.bay_id')
            ->join('schedule_statuses', 'schedule_statuses.id', '=', 'schedules.schedule_status_id')
            ->get();
        return $schedules;
    }
}
