<?php

namespace App\Livewire\DataTable;

use App\Models\Database;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class DataTableListing extends Component
{
    use WithPagination;
    public string $searchSchemaQuery;
    public string $searchTableQuery;
    public collection $databases;

    public function searchDatatable(string $schema, string $table): Builder
    {
        // localhost's mysql only for now
        $blacklistSchema = [
            'information_schema', 'mysql', 'performance_schema', 'phpmyadmin'
        ];

        return DB::connection('mysql')->table('information_schema.tables')
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
        $this->databases = Database::all();
    }

    public function search(): void
    {
        $this->resetPage();
    }

    public function render(): view
    {
        $result = $this->searchDatatable($this->searchSchemaQuery, $this->searchTableQuery);
        return view('livewire.data-table.data-table-listing', [
            'datatables' => $result
                ->paginate(25),
        ]);
    }
}