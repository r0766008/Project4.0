<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserTruck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function index()
    {
        $trucks = UserTruck::where('user_id', auth()->user()->id)->with('truck')->paginate(5);

        return view('user.trucks.index', compact('trucks'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
