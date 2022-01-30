<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'name' => 'author',
            'email' => 'author@gmail.com',
            'password' => Hash::make('123456'),
            'deletable' => false
        ]);
    }
}
