<?php

namespace App\Http\Controllers;

use App\Models\Bay;
use Illuminate\Http\Request;

class BayController extends Controller
{
    public function index()
    {
        return Bay::all();
    }

    public function store(Request $request)
    {
        $bay = Bay::create($request->all());

        return response()->json($bay, 201);
    }

    public function update(Request $request, Bay $bay)
    {
        $bay->update($request->all());

        return response()->json($bay, 200);
    }

    public function delete(Bay $bay)
    {
        $bay->delete();

        return response()->json(null, 204);
    }
}
