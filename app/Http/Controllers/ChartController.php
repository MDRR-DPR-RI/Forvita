<?php

namespace App\Http\Controllers;

use App\Models\Chart;
use App\Models\Clean;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Chart $chart)
    {
        // Query distinct "judul" values from the database
        $juduls = Clean::distinct()->pluck('judul');

        // Query distinct "keterangan" values from the database
        $keterangans = Clean::distinct()->pluck('keterangan');
        return view('dashboard.contents.edit_chart', [
            'active' => 'kelompok23',
            'chart' => $chart,
            'juduls' => $juduls,
            'keterangans' => $keterangans,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chart $chart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chart $chart)
    {
        return "tes";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chart $chart)
    {
        //
    }
}
