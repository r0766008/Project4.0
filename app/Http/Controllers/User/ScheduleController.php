<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\UserTruck;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $usertrucks = UserTruck::where('user_id', auth()->user()->id)->pluck('truck_id')->toArray();
        $schedules = Schedule::whereIn('user_truck_id', $usertrucks)->with('truck')->with('bay')->with('status')
            ->orderBy('schedule_status_id', 'ASC')->orderBy('date', 'DESC')
            ->paginate(10);

        return view('user.schedules.index', compact('schedules'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
}
