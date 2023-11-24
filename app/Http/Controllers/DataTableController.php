<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DataTableController extends Controller
{
    public function index(): View
    {
        return view('data-table.data-table', [

        ]);
    }
}

