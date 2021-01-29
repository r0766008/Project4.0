<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\Bay;
use App\Models\Schedule;
use App\Models\UserTruck;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Truck;

class TruckController extends Controller
{
    public function index()
    {
        return Truck::all();
    }

    public function registerTruckArrival($info) {
        $currentDay = Carbon::now();
        $result = $this->getTruck($currentDay, $info, 1);
        if ($result->count() > 0) {
            Schedule::where([['date', $currentDay->toDateString()], ['user_truck_id', $result[0]->id], ['schedule_status_id', 1]])
                ->first()
                ->update(['schedule_status_id' => 2, 'ata' => $currentDay->toTimeString()]);
            Bay::where('number', 'like', $result[0]->bay_number)->first()->update(['bay_status_id' => 2]);
        }
        return response()->json($result->first());
    }

    public function registerTruckDeparture($info) {
        $currentDay = Carbon::now();
        $result = $this->getTruck($currentDay, $info, 2);
        if ($result->count() > 0) {
            Schedule::where([['date', 'like', $currentDay->toDateString()], ['user_truck_id', 'like', $result[0]->id], ['schedule_status_id', 'like', 2]])
                ->first()
                ->update(['schedule_status_id' => 3, 'atd' => $currentDay->toTimeString()]);
            if (Schedule::where([['bay_id', 'like', $result[0]->bay_number], ['schedule_status_id', 'like', 2]])->count() == 0) {
                Bay::where('number', 'like', $result[0]->bay_number)->first()->update(['bay_status_id' => 1]);
            }
        }
        return response()->json($result->first());
    }

    public function getTruck(Carbon $currentDay, $info, $id)
    {
        return UserTruck::select('trucks.id', 'license_plate', 'rfid', 'company', 'date', 'eta', 'ata', 'atd', 'number AS bay_number')
            ->join('schedules', 'user_trucks.id', '=', 'schedules.user_truck_id')
            ->join('trucks', 'trucks.id', '=', 'user_trucks.truck_id')
            ->join('bays', 'schedules.bay_id', '=', 'bays.id')
            ->where([['date', $currentDay->toDateString()], ['license_plate', $info], ['schedule_status_id', $id]])
            ->orWhere([['date', $currentDay->toDateString()], ['rfid', $info], ['schedule_status_id', $id]])
            ->get();
    }
}
