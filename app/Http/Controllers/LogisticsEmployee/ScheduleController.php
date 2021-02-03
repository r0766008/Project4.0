<?php

namespace App\Http\Controllers\LogisticsEmployee;

use App\Http\Controllers\Controller;
use App\Models\Bay;
use App\Models\Schedule;
use App\Models\ScheduleStatus;
use App\Models\UserTruck;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::with('truck')->with('bay')->with('status')->paginate(10);

        return view('logisticsemployee.schedules.index', compact('schedules'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trucks = UserTruck::with('truck')->with('user')->get();
        $bays = Bay::get();
        return view('logisticsemployee.schedules.create', compact('trucks', 'bays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'user_truck_id' => 'required',
            'bay_id' => 'required'
        ]);

        Schedule::create($request->all());

        return redirect()->route('logisticsemployee.schedules.index')
            ->with('success', 'Schedule has successfully been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::with('truck')->with('bay')->with('status')->findOrFail($id);
        return view('logisticsemployee.schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $trucks = UserTruck::with('truck')->with('user')->get();
        $bays = Bay::get();
        $statuses = ScheduleStatus::get();
        return view('logisticsemployee.schedules.edit', compact('schedule', 'trucks', 'bays', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'date' => 'required',
            'user_truck_id' => 'required',
            'bay_id' => 'required'
        ]);
        $schedule->update($request->all());

        return redirect()->route('logisticsemployee.schedules.index')
            ->with('success', 'Schedule has successfully been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('logisticsemployee.schedules.index')
            ->with('success', 'Schedule has successfully been deleted.');
    }

    public function daySchedule(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'time_interval' => 'required|integer',
            'user_truck_id' => 'required'
        ]);

        $bays = Bay::pluck('id')->toArray();
        $newtime = date("H:i", strtotime('+0 minutes', strtotime($request->start_time)));
        $i = 0;
        foreach ($request->user_truck_id as $usertruck) {
            $bay = $bays[$i];
            Schedule::create([
                'date' => $request->date,
                'eta' => $newtime,
                'user_truck_id' => $usertruck,
                'bay_id' => $bay,
                'schedule_status_id' => 1
            ]);
            if ($bay == $bays[count($bays) - 1]) {
                $i = 0;
                $newtime = date("H:i", strtotime('+' . $request->time_interval . ' minutes', strtotime($newtime)));
                if (strtotime($newtime) > strtotime($request->end_time)) {
                    return redirect()->route('logisticsemployee.schedules.index')
                        ->with('warning', 'Not everyone could have been planned within the given time frame.');
                }
            } else $i++;
        }

        return redirect()->route('logisticsemployee.schedules.index')
            ->with('success', 'Schedule has successfully been created.');
    }
}
