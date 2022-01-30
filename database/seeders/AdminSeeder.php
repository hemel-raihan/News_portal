<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::updateOrCreate([
            'role_id' => Role::where('slug', 'admin')->first()->id,
            'name' => 'Admin',
            'email' => 'hemel@gmail.com',
            'password' => Hash::make('123456'),
            'deletable' => false
        ]);
    }
}
