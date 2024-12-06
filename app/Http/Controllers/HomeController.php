<?php

namespace App\Http\Controllers;

use App\Models\HeiAcct;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}

public function showDashboard()
{
    // Fetch the hei_name from the database
    $hei_name = HeiAcct::first()->hei_name;  // Assuming you want the first record's hei_name

    // Pass it to the view
    return view('dashboard', compact('hei_name'));
}
