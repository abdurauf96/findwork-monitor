<?php

namespace App\Http\Controllers;
use App\Services\TableService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TableController
{
    public function __construct(protected TableService $tableService){}

    public function index()
    {
        $tables = $this->tableService->getAllTables();
        return view('pages.tables.index',compact('tables'));
    }

    public function show($table,Request $request)
    {
        $data = $this->tableService->getTableData($table);
        return view('pages.tables.show',$data);
    }

}
