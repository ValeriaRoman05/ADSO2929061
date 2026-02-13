<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //-> with eloquent: ORM
        $user = new User();
        $user->document = 75000001;
        $user->fullname = 'Jhon Wick';
        $user->gender = 'Male';
        $user->birthdate = '1975-1-10';
        $user->phone = '3200000001';
        $user->email = 'jhon@gmail.com';
        $user->password = bcrypt('admin');
        $user->role = 'admin';
        $user->save();

        //Whit Array

        DB::table('users')->insert([
            'document' => 75000002,
            'fullname' => 'Lara Croft',
            'gender' => 'female',
            'birthdate' => '1968-02-14',
            'phone' => '32000002',
            'email' => 'larac@gmailo.com',
            'password'=> bcrypt('12345'),
            'created_at'=> now(),
            'updated_at'=> now()
        ]);
    }
}
