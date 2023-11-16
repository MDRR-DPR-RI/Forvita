<?php

namespace App\Livewire\Databases;

use App\Models\Database;
use App\Services\DatabaseService;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class DatabaseListing extends Component
{
    protected DatabaseService $databaseService;
    public Collection $databases;
    public string $searchDatabaseQuery;

    public function mount(): void
        // runs the first time the page is loaded.
    {
        $this->databaseService = new DatabaseService();
        $this->databases = Database::all();
    }

    public function searchDatabase(): void
    {
        $this->databases = $this->databaseService
            ->searchDatabase($this->searchDatabaseQuery);
    }

    public bool $useUrl;
    public string $name;
    public string $url;
    public string $driver;
    public string $host;
    public string $port;
    public string $database;
    public string $username;
    public string $password;

    public function store(): void
    {
        $validated = $this->validate([
            'name' => 'required|max:255',
            'url' => 'exclude_if:useUrl,false|required',
            'driver' => 'required',
            'host' => 'required',
            'port' => 'required|numeric',
            'database' => 'required',
            'username' => 'required',
            'password' => 'required',
        ],[
            'name.required' => 'Dibutuhkan nama (custom) database.',
        ]);

        Database::create($validated);
    }

    public function update(): void
    {

    }

}