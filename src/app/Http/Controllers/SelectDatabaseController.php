<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class SelectDatabaseController
{
    public function show()
    {
        return view('select-database');
    }
    public function store(Request $request)
    {
        $request->validate([
            'selected_db' => 'required|in:client,admin',
        ]);

        session(['selected_db' => $request->selected_db]);
        return redirect()->route('home');
    }

}
