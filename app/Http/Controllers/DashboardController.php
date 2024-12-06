<?php

namespace App\Http\Controllers;

use App\Models\HeisAcct;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        // Fetch the hei_name
        $hei_name = HeisAcct::first()->hei_name;  // Or use DB facade to query directly

        // Pass it to the view
        return view('dashboard', compact('hei_name'));
    }
}
