<?php

namespace App\Http\Controllers;

use App\Models\Scheduler;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SchedulerController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function show(Request $request): View
    {
        return view('scheduler.scheduler', [
            'schedulers' => Scheduler::all(),
        ]);
    }

    public function execute(Request $request) {

    }
}
