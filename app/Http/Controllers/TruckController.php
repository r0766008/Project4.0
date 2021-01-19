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
