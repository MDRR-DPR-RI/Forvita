<?php

namespace App\Http\Controllers;

use App\Models\ExcelModel;
use App\Exports\ExcelExport;
use App\Imports\ExcelImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $excel = ExcelModel::all();
        return view('EXCEL.excel', compact('excel'));
    }


    public function ExcelExport()
    {
        return Excel::download(new ExcelExport, 'data.xlsx');
    }


    public function excelimport(Request $request)
    {
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('Data', $namaFile);

        Excel::import(new ExcelImport, public_path('/Data/' . $namaFile));
        return redirect('excel');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
