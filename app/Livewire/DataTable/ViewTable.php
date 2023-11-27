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
    use WithPagination;
    public string $schemaName = '';
    public string $tableName = '';

    public function getTableRows(string $schemaName, string $tableName): Builder
    {
        return DB::table($schemaName.'.'.$tableName);
    }

    public function getTableColumns(string $schemaName, string $tableName): Collection
    {
        return DB::table('information_schema.columns')
            ->select('columns.column_name')
            ->where('columns.TABLE_SCHEMA', '=', $schemaName)
            ->where('columns.TABLE_NAME', '=', $tableName)
            ->get();
    }

    public function render(): View
    {
        $result = $this->getTableRows($this->schemaName, $this->tableName);
        return view('livewire.data-table.view-table', [
            'columnNames' => $this->getTableColumns($this->schemaName, $this->tableName),
            'rows' => $result->paginate(25),
        ]);
    }
}