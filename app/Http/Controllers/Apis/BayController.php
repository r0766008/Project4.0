<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\Bay;
use Illuminate\Http\Request;

class BayController extends Controller
{
    public function index()
    {
        return Bay::all();
    }
}
