<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\Bay;
use Illuminate\Http\Request;

class BayController extends Controller
{
    public function index()
    {
        return Bay::select('bays.*', 'bay_statuses.name')
            ->join('bay_statuses', 'bay_statuses.id', '=', 'bays.bay_status_id')
            ->get();
    }
}
