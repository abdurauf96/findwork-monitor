<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>"AdminFindWork",
            'email'=>"findworkadmin@gmail.com",
            'password'=>Hash::make('baron9667#')
        ]);
    }
}
