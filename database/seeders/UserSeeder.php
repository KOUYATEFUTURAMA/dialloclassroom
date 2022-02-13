<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Super admin",
            'email' => 'super-admin@app.com',
            'contact' => '0000000000',
            'role' => 'Concepteur',
            'password' => bcrypt('diallo-classrom@2022'),
            'created_at' => now()
        ]);
    }
}
