<?php

namespace App\Http\Controllers\LoadingEmployee;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\UserBay;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $currentDay = Carbon::now();
        $userbays = UserBay::where('user_id', auth()->user()->id)->pluck('bay_id')->toArray();
        $schedules = Schedule::where('date', $currentDay->toDateString())->whereIn('bay_id', $userbays)
            ->with('truck')->with('bay')->with('status')
            ->latest()->orderBy('eta', 'desc')->orderBy('schedule_status_id', 'asc')->paginate(5);

        return view('loadingemployee.schedule.index', compact('schedules'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
