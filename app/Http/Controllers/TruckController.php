<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truck;

class TruckController extends Controller
{
    public function index()
    {
        return Truck::all();
    }

    public function getBayByInfo($info) {
        $result = Truck::select('number_plate', 'rfid', 'company', 'date', 'time', 'number AS bay_number')
            ->where('number_plate', $info)
            ->orWhere('rfid', $info)
            ->join('schedules', 'trucks.id', '=', 'schedules.truck_id')
            ->join('bays', 'schedules.bay_id', '=', 'bays.id')
            ->get();
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
}
