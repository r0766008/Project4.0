<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Truck;
use App\Models\User;
use App\Models\UserTruck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trucks = Truck::paginate(10);

        return view('admin.trucks.index', compact('trucks'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trucks.create');
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
            'license_plate' => 'required',
            'rfid' => 'required',
            'company' => 'required'
        ]);

        Truck::create($request->all());

        return redirect()->route('admin.trucks.index')
            ->with('success', 'Truck has successfully been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        return view('admin.trucks.show', compact('truck'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit(Truck $truck)
    {
        $userIds = UserTruck::where('truck_id', $truck->id)->pluck('user_id')->toArray();
        $users = UserTruck::where('truck_id', $truck->id)->with('user')->latest()->paginate(5);
        $remainingusers = User::whereNotIn('id', $userIds)->where('role_id', 1)->get();
        return view('admin.trucks.edit', compact('truck', 'users', 'remainingusers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Truck $truck)
    {
        $request->validate([
            'license_plate' => 'required',
            'rfid' => 'required',
            'company' => 'required'
        ]);
        $truck->update($request->all());

        return redirect()->route('admin.trucks.index')
            ->with('success', 'Truck has successfully been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Truck $truck)
    {
        $truck->delete();

        return redirect()->route('admin.trucks.index')
            ->with('success', 'Truck has successfully been deleted.');
    }

    public function addDriver($truckId, Request $request) {
        UserTruck::create([
            'user_id' => $request->user_id,
            'truck_id' => $truckId,
            'created_at' => now()
        ]);

        $truck = Truck::find($truckId);
        return redirect()->route('admin.trucks.edit', $truck)
            ->with('success', 'Driver has successfully been added.');
    }

    public function deleteDriver($truckId, $userId) {
        UserTruck::where([['truck_id', $truckId], ['user_id', $userId]])->delete();

        $truck = Truck::find($truckId);
        return redirect()->route('admin.trucks.edit', $truck)
            ->with('success', 'Driver has successfully been deleted.');
    }
}
