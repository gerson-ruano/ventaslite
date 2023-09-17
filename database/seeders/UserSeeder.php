<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Gerson Ruano',
            'phone'=>'23423424',
            'email'=>'toge@gmail.com',
            'profile'=>'Admin',
            'status'=>'Active',
            'password'=>bcrypt('12341234')
        ]);
        User::create([
            'name'=>'Invitado',
            'phone'=>'1029534344',
            'email'=>'invitado@gmail.com',
            'profile'=>'Employee',
            'status'=>'Active',
            'password'=>bcrypt('12341234')
        ]);
    }
}
