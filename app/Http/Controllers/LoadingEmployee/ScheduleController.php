<?php

namespace App\Http\Controllers\LoadingEmployee;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\ScheduleStatus;
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

    public function show($id)
    {
        $statuses = ScheduleStatus::all();
        $schedule = Schedule::with('truck')->with('bay')->with('status')->findOrFail($id);
        return view('loadingemployee.schedule.show', compact('schedule', 'statuses'));
    }

    public function changeStatus($id, Request $request)
    {
        Schedule::find($id)->update(['schedule_status_id' => $request->schedule_status_id]);
        return redirect()->route('schedule.index')
            ->with('success', 'Status has successfully been changed.');
    }
}
