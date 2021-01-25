<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Models\ScheduleStatus;
use App\Models\Truck;
use App\Models\Bay;
use App\Models\Schedule;
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
        $schedules = Schedule::with('truck')->with('bay')->with('status')->latest()->paginate(5);

        return view('schedules.index', compact('schedules'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trucks = Truck::get();
        $bays = Bay::get();
        return view('schedules.create', compact('trucks', 'bays'));
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
            'truck_id' => 'required',
            'bay_id' => 'required'
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedules.index')
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
        return view('schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $trucks = Truck::get();
        $bays = Bay::get();
        $statuses = ScheduleStatus::get();
        return view('schedules.edit', compact('schedule', 'trucks', 'bays', 'statuses'));
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
            'truck_id' => 'required',
            'bay_id' => 'required'
        ]);
        $schedule->update($request->all());

        return redirect()->route('schedules.index')
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

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule has successfully been deleted.');
    }
}
