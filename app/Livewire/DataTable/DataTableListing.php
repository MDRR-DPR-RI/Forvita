<?php

namespace App\Livewire\DataTable;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class DataTableListing extends Component
{
    public string $searchSchemaQuery;
    public string $searchTableQuery;

    public function searchDatatable(string $schema, string $table): Builder
    {
        $blacklistSchema = [
            'information_schema', 'mysql', 'performance_schema', 'phpmyadmin'
        ];
        return DB::table('information_schema.tables')
            ->select('tables.TABLE_SCHEMA', 'tables.TABLE_NAME')
            ->whereNotIn('tables.TABLE_SCHEMA', $blacklistSchema)
            ->whereNot(function (Builder $query) {
                $blacklistDatasetTable = [
                    'charts', 'clusters', 'contents', 'dashboards', 'databases', 'failed_jobs',
                    'migrations', 'password_reset_tokens', 'permissions', 'personal_access_tokens',
                    'prompts', 'roles', 'schedulers', 'shares', 'users'
                ];
                $query->where('tables.TABLE_SCHEMA', '=', 'dataset')
                    ->whereIn('tables.TABLE_NAME', $blacklistDatasetTable);
            })
            ->where('tables.TABLE_SCHEMA', 'LIKE', '%'.$schema.'%')
            ->where('tables.TABLE_NAME', 'LIKE', '%'.$table.'%');
    }

    public function mount(): void
    {
        $this->searchSchemaQuery = "";
        $this->searchTableQuery = "";
    }

    public function search(): void
    {
        $this->resetPage();
    }

    public function render(): view
    {
        return view('livewire.data-table.data-table-listing', [
            'datatables' => $this->searchDatatable($this->searchSchemaQuery, $this->searchTableQuery)
                ->paginate(15),
        ]);
    }
}