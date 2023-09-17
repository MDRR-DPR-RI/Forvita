<?php

namespace App\Http\Controllers;

use App\Models\Ruu;
use App\Models\Agenda;
use App\Http\Requests\StoreRUURequest;
use App\Http\Requests\UpdateRUURequest;

class RUUController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.contents.kelompok23', [
            'active' => 'kelompok23',
            'ruu' => Ruu::all(),
            'agenda' => Agenda::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRUURequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RUU $rUU)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RUU $rUU)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRUURequest $request, RUU $rUU)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RUU $rUU)
    {
        //
    }
}
