<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Agenda;
use App\Models\Ruu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('dashboard.contents.kelompok23', [
        //     'active' => 'kelompok23',
        //     'ruu' => Ruu::all(),
        //     'agenda' => Agenda::all(),
        //     'contents' => Content::all()
        // ]);
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
    public function show(Content $content)
    {
        //
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
        //
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
