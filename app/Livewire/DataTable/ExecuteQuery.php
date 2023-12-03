<?php

namespace App\Livewire\DataTable;

use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class ExecuteQuery extends ModalComponent
{
    use WithPagination;

    public string $query = '';
    public string $schemaName = '';
    public string $tableName = '';

    public array|Collection $results;
    public string $success = '';
    public string $error = '';

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

    public function executeRawQuery(string $query, string $schema = null, string $table = null)
    {
        if (is_null($schema) or is_null($table))
        {
            return DB::select($query);
        }
        else
        {
            return DB::table($schema.'.'.$table)->select($query);
        }
    }

    public function executeQuery()
    {
        $this->results = [];
        $this->success = '';
        $this->error = '';

        try {
            $this->results = $this->executeRawQuery($this->query);
            $this->success = "Query berhasil dijalankan.";
        } catch (Exception $ex) {
            $this->error = "Gagal menjalankan query: \n".substr($ex, 0, 200);
            error_log("Query gagal dijalankan: " . $ex);
        }

    }

    public function render(): View
    {
        $results = [];
        if (isset($this->results))
        {
            $results = $this->results;
        }
        if (isset($this->success))
        {
            $success = $this->success;
        }
        if (isset($this->error))
        {
            $error = $this->error;
        }
        return view('livewire.data-table.execute-query', [
            'results' => $results,
            'success' => $success,
            'error' => $error,
        ]);
    }
}