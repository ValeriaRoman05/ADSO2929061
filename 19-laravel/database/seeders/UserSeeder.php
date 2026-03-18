<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //-> with Eloquent: ORM
        $user = new User;
        $user->document = 75000001;
        $user->fullname = 'John Wick';
        $user->gender = 'Male';
        $user->birthdate = '1964-09-02';
        $user->phone = '3200000001';
        $user->email = 'john@mail.com';
        $user->password = bcrypt('admin');
        $user->role = 'Admin';
        $user->save();

        //-> with Array: ORM
        DB::table('users')->insert([
            'document'=> 75000002,
            'fullname'=> 'Lara Croft',
            'gender'=> 'Female',
            'birthdate'=> '1968-02-14',
            'phone'=> 3200000002,
            'email'=> 'larac@mail.com',
            'password'=> bcrypt('12345'),
            'created_at' => now(),
            'updated_at'=> now()
        ]);
    }
}
