<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Clean;
use Illuminate\Http\Request;

class ContentController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Content::create([
            'chart_id' => $request->input('chartId'),
        ]);
        return redirect('/kelompok23');
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        // Query distinct "judul" values from the database
        $juduls = Clean::distinct()->pluck('judul');

        // Query distinct "keterangan" values from the database
        $keterangans = Clean::distinct()->pluck('keterangan');
        return view('dashboard.contents.edit_chart', [
            'active' => 'kelompok23',
            'cleanAll' => Clean::all(),
            'content' => $content,
            'juduls' => $juduls,
            'keterangans' => $keterangans,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Content $content)
    {
        $selectedXValues = $request->input('xValue');
        if ($selectedXValues) {
            $count = [];
            // asign jumlah for all selectedValues
            for ($i = 0; $i < count($selectedXValues); $i++) {
                $clean = Clean::where('keterangan', $selectedXValues[$i])->first(); // find row that = slectedXValues
                array_push($count, $clean->jumlah);
            }
            $content->update([
                'judul' => $request->selectedJudul,
                'x_value' => json_encode($selectedXValues),
                'y_value' => $count
            ]);
        } else {
            $content->update([
                'data' => null,
                'x_value' => null,
                'y_value' => null
            ]);
        }

        return redirect('/kelompok23');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        Content::destroy($content->id);
        return redirect('/kelompok23');
    }
}
