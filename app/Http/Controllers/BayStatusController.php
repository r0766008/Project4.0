<?php

namespace App\Http\Controllers;

use App\Models\BayStatus;
use Illuminate\Http\Request;

class BayStatusController extends Controller
{
    public function index()
    {
        return BayStatus::all();
    }

    public function store(Request $request)
    {
        $baystatus = BayStatus::create($request->all());

        return response()->json($baystatus, 201);
    }

    public function update(Request $request, BayStatus $baystatus)
    {
        $baystatus->update($request->all());

        return response()->json($baystatus, 200);
    }

    public function delete(BayStatus $baystatus)
    {
        $baystatus->delete();

        return response()->json(null, 204);
    }
}
