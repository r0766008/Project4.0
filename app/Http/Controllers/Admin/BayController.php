<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bay;
use App\Models\BayStatus;
use Illuminate\Http\Request;

class BayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bays = Bay::with('status')->paginate(5);

        return view('admin.bays.index', compact('bays'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bays.create');
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
            'number' => 'required'
        ]);

        Bay::create($request->all());

        return redirect()->route('admin.bays.index')
            ->with('success', 'Bay has successfully been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bay  $bay
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bay = Bay::with('status')->findOrFail($id);
        return view('admin.bays.show', compact('bay'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bay  $bay
     * @return \Illuminate\Http\Response
     */
    public function edit(Bay $bay)
    {
        $statuses = BayStatus::get();
        return view('admin.bays.edit', compact('bay', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bay  $bay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bay $bay)
    {
        $request->validate([
            'number' => 'required'
        ]);
        $bay->update($request->all());

        return redirect()->route('admin.bays.index')
            ->with('success', 'Bay has successfully been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bay  $bay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bay $bay)
    {
        $bay->delete();

        return redirect()->route('admin.bays.index')
            ->with('success', 'Bay has successfully been deleted.');
    }
}
