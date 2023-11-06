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
        if ($request->tableau_link) {
            $content = Content::create([
                'chart_id' => 1,
                'dashboard_id' => $request->dashboard_id, // input hidden
                'card_grid' => $request->card_grid, // input hidden
                'card_description' => $request->tableau_link,
            ]);
            return redirect()->back()->with('success', 'Successfully to embed Tableau');
        }
        $content = Content::create([
            'chart_id' => $request->chart_id, // input hidden
            'dashboard_id' => $request->dashboard_id, // input hidden
            'card_grid' => $request->card_grid, // input hidden
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
        // dd(($request->selected_judul));
        // Query distinct(unique) "judul" values from the database
        $cleans = Clean::select('group', 'data', 'judul')
            ->distinct('judul')
            ->get();

        if (!$request->selected_judul) { // first edit chart page 
            return view('dashboard.contents.edit_chart', [
                'dashboard' => $content->dashboard,
                'content' => $content,
                'cleans' => $cleans,
            ]);
        }
        // NEXT>>
        $arr_selected_judul = explode(",", $request->selected_judul);
        // dd($arr_selected_judul);
        $data = [
            'dashboard' => $content->dashboard,
            'content' => $content,
        ];
        $stackCount = 0;
        for ($i = 0; $i < count($arr_selected_judul); $i++) {
            $clean_based_selected_val = Clean::where('judul', $arr_selected_judul[$i]) // take the cleans data based on selectedJudul
                ->where('newest', true) // take the newest data
                ->get();
            $data['clean' . $i] = $clean_based_selected_val;
            $stackCount++;
        }
        $data['stackCount'] = $stackCount;
        // dd($data);
        return view('dashboard.contents.next-edit-chart', $data);
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
        $stackCount = $request->stackCount;
        $x_value = [];
        $y_value = [];
        $color_array = [];
        if ($stackCount > 1) { // stack chart / multiple stack
            $judul_array = [];
            for ($i = 0; $i < $request->stackCount; $i++) {
                $selectedXValues = $request->input('xValue' . $i);
                $x = [];
                $y = [];
                // dd($selectedXValues);
                for ($j = 0; $j < count($selectedXValues); $j++) {
                    $clean = Clean::where('keterangan', $selectedXValues[$j])
                        ->where('judul', $request->input('selectedJudul' . $i))
                        ->first(); // find row that = slectedXValues
                    if ($clean) {
                        // Convert the string to an integer and add it to the $y_value array
                        $numericValue = intval($clean->jumlah);
                        $x[] = $clean->keterangan;
                        $y[] = $numericValue;
                    }
                }
                $judul_array[] = $request->input('selectedJudul' . $i);
                $x_value[] = $x;
                $y_value[] = $y;
                $color_array[] = $request->input('color_picker' . $i);
            }
            $content->update([
                'judul' => $judul_array,
                'card_title' => $request->card_title,
                'card_description' => $request->card_description,
                'card_grid' => $request->card_grid,
                'result_prompt' => null,
                'x_value' => json_encode($x_value),
                'y_value' => json_encode($y_value),
                'color' => json_encode($color_array),
            ]);
        } else { // single chart
            $x = [];
            $y = [];
            $color_array = $request->input('color_picker');
            if (gettype($color_array) != 'array') {
                $color_array[] = $request->input('color_picker0');
            }
            // asign jumlah for all selectedValues
            for ($i = 0; $i < count($request->input('xValue0')); $i++) {
                $clean = Clean::where('keterangan', $request->input('xValue0')[$i])
                    ->where('judul', $request->input('selectedJudul0'))
                    ->first(); // find row that = slectedXValues
                if ($clean) {
                    // Convert the string to an integer and add it to the $y_value array
                    $numericValue = intval($clean->jumlah);
                    $x[] = $clean->keterangan;
                    $y[] = $numericValue;
                }
            }
            $x_value[] = $x;
            $y_value[] = $y;
            $judul_array[] = $request->input('selectedJudul0');

            $content->update([
                'judul' => $judul_array,
                'card_title' => $request->card_title,
                'card_description' => $request->card_description,
                'card_grid' => $request->card_grid,
                'result_prompt' => null,
                'x_value' => json_encode($x_value),
                'y_value' => json_encode($y_value),
                'color' => json_encode($color_array),
            ]);
        }
        // if ($selectedXValues) {
        // } else { // if the user did not select any data(x_value) then update null
        //     $content->update([
        //         'data' => null,
        //         'x_value' => null,
        //         'y_value' => null
        //     ]);
        // }
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
