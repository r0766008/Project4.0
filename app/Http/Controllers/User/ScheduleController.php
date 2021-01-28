<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $id = auth()->user()->truck_id;
        $schedules = Schedule::where('truck_id', $id)->with('truck')->with('bay')->with('status')
            ->orderBy('schedule_status_id', 'ASC')->orderBy('date', 'DESC')
            ->paginate(5);

        return view('user.schedules.index', compact('schedules'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
