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
        // Create and store the content in the database
        $content = Content::create([
            'chart_id' => $request->input('chartId'),
            'dashboard' => $request->input('dashboard'),
        ]);

        // Retrieve the ID of the newly created content
        $contentId = $content->id;

        // Go to edit page after cretaed new chart
        return redirect('/dashboard/content/' . $contentId)->with('dashboard', $request->dashboard);
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content, Request $request)
    {
        // Query distinct "judul" values from the database
        $juduls = Clean::distinct()->pluck('judul');
        $dashboard = $request->session()->get('dashboard');

        if (isset($dashboard) || $dashboard != null) { // add new chart, code goes here
            $dashboard = $request->session()->get('dashboard');
        } else { // edit chart, code goes here
            $dashboard = $request->query('dashboard');
        }
        // Query distinct "keterangan" values from the database
        $keterangans = Clean::distinct()->pluck('keterangan');
        return view('dashboard.contents.edit_chart', [
            'dashboard' => $dashboard,
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
                if ($clean) {
                    // Convert the string to an integer and add it to the $count array
                    $numericValue = intval($clean->jumlah);
                    $count[] = $numericValue;
                }
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

        return redirect('/' . $request->dashboard)->with('success', 'Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content, Request $request)
    {
        Content::destroy($content->id);
        return redirect('/' . $request->dashboard)->with('deleted', "Chart has been deleted!");
    }
}
