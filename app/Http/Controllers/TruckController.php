<?php

namespace App\Http\Controllers;

use App\Models\Bay;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Truck;

class TruckController extends Controller
{
    public function index()
    {
        return Truck::all();
    }

    public function registerTruckOnPremise($info) {
        $currentDay = Carbon::now();
        $result = Truck::select('trucks.id', 'license_plate', 'rfid', 'company', 'date', 'eta', 'ata', 'atd', 'number AS bay_number')
            ->where('license_plate', $info)
            ->orWhere('rfid', $info)
            ->join('schedules', 'trucks.id', '=', 'schedules.truck_id')
            ->join('bays', 'schedules.bay_id', '=', 'bays.id')
            ->get();
        if (Schedule::where([['date', 'like', $currentDay->toDateString()], ['truck_id', 'like', $result[0]->id], ['schedule_status_id', 'like', 1]])->count() > 0) {
            Schedule::where([['date', 'like', $currentDay->toDateString()], ['truck_id', 'like', $result[0]->id], ['schedule_status_id', 'like', 1]])
                ->first()
                ->update(['schedule_status_id' => 2, 'ata' => $currentDay->toTimeString()]);
        }
        Bay::where('number', 'like', $result[0]->bay_number)->first()->update(['bay_status_id' => 2]);
        return response()->json($result);
    }

    public function registerTruckFinished($info) {
        $currentDay = Carbon::now();
        $result = Truck::select('trucks.id', 'license_plate', 'rfid', 'company', 'date', 'eta', 'ata', 'atd', 'number AS bay_number')
            ->where('license_plate', $info)
            ->orWhere('rfid', $info)
            ->join('schedules', 'trucks.id', '=', 'schedules.truck_id')
            ->join('bays', 'schedules.bay_id', '=', 'bays.id')
            ->get();
        if (Schedule::where([['date', 'like', $currentDay->toDateString()], ['truck_id', 'like', $result[0]->id], ['schedule_status_id', 'like', 2]])->count() > 0) {
            Schedule::where([['date', 'like', $currentDay->toDateString()], ['truck_id', 'like', $result[0]->id], ['schedule_status_id', 'like', 2]])
                ->first()
                ->update(['schedule_status_id' => 3, 'atd' => $currentDay->toTimeString()]);
        }
        if (Schedule::where([['bay_id', 'like', $result[0]->bay_number], ['schedule_status_id', 'like', 2]])->count() == 0) {
            Bay::where('number', 'like', $result[0]->bay_number)->first()->update(['bay_status_id' => 1]);
        }
        return response()->json($result);
    }

    public function store(Request $request)
    {
        $truck = Truck::create($request->all());

        return response()->json($truck, 201);
    }

    public function update(Request $request, Truck $truck)
    {
        $truck->update($request->all());

        return response()->json($truck, 200);
    }

    public function delete(Truck $truck)
    {
        $truck->delete();

        return response()->json(null, 204);
    }

    public function webIndex() {
        return view('trucks.trucks');
    }
}
