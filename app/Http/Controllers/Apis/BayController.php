<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\Bay;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BayController extends Controller
{
    public function index()
    {
        return Bay::select('bays.*', 'bay_statuses.name')
            ->join('bay_statuses', 'bay_statuses.id', '=', 'bays.bay_status_id')
            ->get();
    }

    public function schedules()
    {
        $bays = Bay::select('bays.*', 'bay_statuses.name')
            ->join('bay_statuses', 'bay_statuses.id', '=', 'bays.bay_status_id')
            ->get();
        $currentDay = Carbon::now();
        $schedules = Schedule::select('schedules.id', 'date', 'eta', 'ata', 'atd', 'trucks.license_plate', 'trucks.company', 'bays.number', 'schedule_statuses.name')
            ->where('date', $currentDay->toDateString())
            ->join('user_trucks', 'user_trucks.id', '=', 'schedules.user_truck_id')
            ->join('trucks', 'trucks.id', '=', 'user_trucks.truck_id')
            ->join('bays', 'bays.id', '=', 'schedules.bay_id')
            ->join('schedule_statuses', 'schedule_statuses.id', '=', 'schedules.schedule_status_id')
            ->get();
        return compact('bays', 'schedules');
    }

    public function starting($id)
    {
        Bay::find($id)->update([
            'bay_status_id' => 3
        ]);
        return Bay::find($id);
    }

    public function stopping($id)
    {
        Bay::find($id)->update([
            'bay_status_id' => 4
        ]);
        return Bay::find($id);
    }
}
