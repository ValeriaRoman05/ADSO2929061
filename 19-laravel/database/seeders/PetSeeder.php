<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Pet = new Pet;
        $Pet->name     = 'Angel';
        $Pet->kind     = 'Dog';
        $Pet->weight   = 10;
        $Pet->age      = 8;
        $Pet->breed    = 'pekines';
        $Pet->location = 'colombia';
        $Pet->description  ='Blanco';
        $Pet->save();

         $Pet = new Pet;
        $Pet->name     = 'Manchas';
        $Pet->kind     = 'Cat';
        $Pet->weight   = 10-5;
        $Pet->age      = 10;
        $Pet->breed    = 'calico';
        $Pet->location = 'colombia';
        $Pet->description  ='multicolor';
        $Pet->save();

         $Pet = new Pet;
        $Pet->name     = 'pepa';
        $Pet->kind     = 'pig';
        $Pet->weight   = 9.5;
        $Pet->age      = 5;
        $Pet->breed    = 'prietran';
        $Pet->location = 'colombia';
        $Pet->description  ='delicioso';
        $Pet->save();
    }
}
