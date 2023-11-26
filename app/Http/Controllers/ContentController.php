<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Content;
use App\Models\Clean;
use App\Models\Prompt;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        if ($request->tableau_link) { // emebed tableau content

            $content = Content::create([
                'chart_id' => 18,
                'dashboard_id' => $request->dashboard_id, // input hidden
                'card_grid' => $request->card_grid,
                'domain_tableau' => $request->domain_tableau,
                'username_tableau' => $request->username_tableau,
                'card_description' => $request->tableau_link, // store tableau url in the content_description coloumn
            ]);
            return redirect()->back()->with('success', 'Successfully to embed Tableau');
        }

        // store content in db
        $content = Content::create([ // basic content
            'chart_id' => $request->chart_id, // input hidden
            'dashboard_id' => $request->dashboard_id, // input hidden
            'card_grid' => $request->card_grid, // input hidden
        ]);

        // Retrieve the ID of the newly created content
        $contentId = $content->id;

        // Go to edit page after cretaed new chart
        return redirect('/dashboard/content/' . $contentId);
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content, Request $request)
    {
        // Query distinct(unique) "judul" values from the database
        $cleans = Clean::select('kelompok', 'data', 'judul')
            ->distinct('judul')
            ->orderBy('kelompok')
            ->get();

        if (!$request->selected_judul) { // first edit chart page 
            return view('dashboard.contents.edit_chart', [
                'dashboard' => $content->dashboard,
                'content' => $content,
                'cleans' => $cleans,
            ]);
        }
        // NEXT_EDIT_CHART(PAGE2 AFTER SELECT JUDUL)>>
        $arr_selected_judul = explode(",", $request->selected_judul);
        // dd($arr_selected_judul);
        $data = [
            'dashboard' => $content->dashboard,
            'content' => $content,
        ];
        $stackCount = 0;
        for ($i = 0; $i < count($arr_selected_judul); $i++) {
            $content_judul = json_decode($content->judul, true);
            if (isset($content_judul[$i]) && $arr_selected_judul[$i] == $content_judul[$i]) {
                $data['clean' . $i] = Clean::where('judul', $arr_selected_judul[$i])
                    ->where('created_at', json_decode($content->clean_created_at)[$i])
                    ->orderBy('keterangan')
                    ->get();
            } else {
                $data['clean' . $i] = Clean::where('judul', $arr_selected_judul[$i])
                    ->where('newest', true)
                    ->orderBy('keterangan')
                    ->get();
            }
            $data['date' . $i] = Clean::select('newest', 'created_at', 'judul')
                ->orderBy('created_at', 'desc') // Order by the latest created_at
                ->where('judul', $arr_selected_judul[$i])
                ->distinct('created_at')
                ->get();
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
        // update content data x/y value
        $x_value = [];
        $y_value = [];
        $color_array = [];
        $created_at = [];
        $judul_array = [];
        $color_array = [];
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
            if (gettype($request->input('color_picker' . $i)) == 'array') {
                $color_array = $request->input('color_picker' . $i);
            } else {
                $color_array[] = $request->input('color_picker' . $i);
            }
            $clean = Clean::where('judul', $request->input('selectedJudul' . $i))
                ->where('created_at', $request->input('filter_date' . $i))
                ->first();
            $carbonDate = Carbon::parse($clean->created_at);
            $created_at[] = $carbonDate->format('Y-m-d H:i:s');
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
            'clean_created_at' => json_encode($created_at),
        ]);

        // if user edit prompt in chartId = 8, then update prompt(id) in the content
        $selectedPrompt = $request->input('selectPrompt');
        if ($selectedPrompt) {
            $content->update([
                'prompt_id' => $selectedPrompt,
            ]);
            // if the user add their own prmopt then store the prompt to the prompt(table)
            $newPrompt = $request->input('newPrompt');
            if ($newPrompt) {
                $prompt =  Prompt::create([
                    'body' => $newPrompt,
                ]);
                $content->update([
                    'prompt_id' => $prompt->id,
                ]);
            }
        }
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
