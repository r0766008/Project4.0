<?php

namespace App\Http\Controllers\LoadingEmployee;

use App\Http\Controllers\Controller;
use App\Models\Bay;
use App\Models\UserBay;
use Illuminate\Http\Request;

class BayController extends Controller
{
    public function index()
    {
        $bays = UserBay::where('user_id', auth()->user()->id)->with('bay')->paginate(5);

        return view('loadingemployee.bays.index', compact('bays'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $userbays = UserBay::where('user_id', auth()->user()->id)->pluck('bay_id')->toArray();
        $bays = Bay::whereNotIn('id', $userbays)->get();
        return view('loadingemployee.bays.create', compact('bays'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bay_id' => 'required'
        ]);

        UserBay::create([
            'user_id' => auth()->user()->id,
            'bay_id' => request()->bay_id
        ]);

        return redirect()->route('loading.bays.index')
            ->with('success', 'Bay has successfully been created.');
    }

    public function destroy(UserBay $bay)
    {
        $bay->delete();

        return redirect()->route('loading.bays.index')
            ->with('success', 'Bay has successfully been deleted.');
    }
}
