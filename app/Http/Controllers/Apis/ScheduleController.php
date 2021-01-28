<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $currentDay = Carbon::now();
        $schedules = Schedule::select('schedules.id', 'date', 'eta', 'ata', 'atd', 'trucks.license_plate', 'trucks.company', 'bays.number', 'schedule_statuses.name')
            ->where('date', $currentDay->toDateString())
            ->join('trucks', 'trucks.id', '=', 'schedules.truck_id')
            ->join('bays', 'bays.id', '=', 'schedules.bay_id')
            ->join('schedule_statuses', 'schedule_statuses.id', '=', 'schedules.schedule_status_id')
            ->get();
        return $schedules;
    }

    public function store(Request $request)
    {
        $schedule = Schedule::create($request->all());

        return response()->json($schedule, 201);
    }

    public function update(Request $request, Schedule $schedule)
    {
        $schedule->update($request->all());

        return response()->json($schedule, 200);
    }

    public function delete(Schedule $schedule)
    {
        $schedule->delete();

        return response()->json(null, 204);
    }

    public function webIndex() {
        return view('schedules.schedules');
    }
}
