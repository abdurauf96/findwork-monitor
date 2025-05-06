<?php

namespace App\Services;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TableService
{
    public function getAllTables(): Collection
    {
        $db = DB::connection();
        $databaseName = $db->getDatabaseName();

        $tables = $db->select("SHOW TABLES");
        $key = "Tables_in_{$databaseName}";

        return collect($tables)->pluck($key);
    }

    public function getTableData(string $table)
    {
        $connection = config('database.default');

        if (!Schema::connection($connection)->hasTable($table)) {
            return null;
        }

        $columns = Schema::connection($connection)->getColumnListing($table);
        $rows = DB::connection($connection)->table($table)->paginate(10);

        return compact('columns', 'rows', 'table');
    }
}
