<?php

namespace App\Livewire\DataTable;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class ViewTable extends ModalComponent
{

    public string $schemaName = '';
    public string $tableName = '';

    public function getTableRows(string $schemaName, string $tableName)
    {
        return DB::table($schemaName.'.'.$tableName);
    }

    public function render()
    {
        $result = $this->getTableRows($this->schemaName, $this->tableName);
        return view('livewire.data-table.view-table', [
            'rows' => $result->paginate(25),
            'firstRow' => $result->first(),
        ]);
    }
}