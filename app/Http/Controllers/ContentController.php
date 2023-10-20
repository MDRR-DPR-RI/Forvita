<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Content;
use App\Models\Clean;
use App\Models\Prompt;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create and store the content in the database
        $content = Content::create([
            'chart_id' => $request->chart_id, // input hidden
            'dashboard_id' => $request->dashboard_id, // input hidden
        ]);

        // Retrieve the ID of the newly created content
        $contentId = $content->id;

        // Go to edit page after cretaed new chart, the nset session to use in edit page in show function
        return redirect('/dashboard/content/' . $contentId);
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content, Request $request)
    {
        // Query distinct(unique) "judul" values from the database
        $juduls = Clean::distinct()->pluck('judul');

        // Query distinct(unique) "keterangan" values from the database
        $keterangans = Clean::distinct()->pluck('keterangan');

        return view('dashboard.contents.edit_chart', [
            'dashboard' => $content->dashboard,
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
        // after AI Analysis, asign result_prompt to the content
        $resultPrompt = $request->input('result');
        if ($resultPrompt) {
            return $content->update([
                'result_prompt' => $resultPrompt,
            ]);
        }

        // if user edit prompt in chartId = 8, then update prompt(id) in the content
        $selectedPrompt = $request->input('selectPrompt');
        if ($selectedPrompt) {
            $content->update([
                'prompt_id' => $selectedPrompt,
            ]);
            // if the user add their own prmopt then store the prompt to the prompt(table)
            $newPrompt = $request->input('newPrompt');
            if ($newPrompt) {
                Prompt::create([
                    'body' => $newPrompt,
                ]);
            }
            // redirect with send dashboard_id variable to the dashboard routes
            return redirect('/dashboard/' . $request->dashboard_id)->with('success', 'Successfully to update prompt');
        }

        // update content data x/y value
        $selectedXValues = $request->input('xValue');
        if ($selectedXValues) {
            $y_value = [];
            // asign jumlah for all selectedValues
            for ($i = 0; $i < count($selectedXValues); $i++) {
                $clean = Clean::where('keterangan', $selectedXValues[$i])->first(); // find row that = slectedXValues
                if ($clean) {
                    // Convert the string to an integer and add it to the $y_value array
                    $numericValue = intval($clean->jumlah);
                    $y_value[] = $numericValue;
                }
            }
            $content->update([
                'judul' => $request->selectedJudul,
                'result_prompt' => null,
                'x_value' => json_encode($selectedXValues),
                'y_value' => $y_value
            ]);
        } else { // if the user did not select any data(x_value) then update null
            $content->update([
                'data' => null,
                'x_value' => null,
                'y_value' => null
            ]);
        }
        // redirect with send dashboard_id variable to the dashboard routes
        return redirect('/dashboard/' . $request->dashboard_id)->with('success', 'Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        Content::destroy($content->id);

        // redirect with send dashboard_id variable to the dashboard routes
        return redirect('/dashboard/' . $content->dashboard->id)->with('deleted', "Chart has been deleted!");
    }
}
