<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Pet;

class Petseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $pet = new Pet;
        $pet->name = 'Aaron';
        $pet->kind = 'Cat';
        $pet->weight = 10.5;
        $pet->age = 6;
        $pet->breed = 'Native';
        $pet->location = 'Colombia';
        $pet->description = 'hermoso';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Lio';
        $pet->kind = 'Cat';
        $pet->weight = 6;
        $pet->age = 7;
        $pet->breed = 'Bicolor';
        $pet->location = 'Colombia';
        $pet->description = 'Tiene una bacteria que puede disminuir su peso y debilitar si salud';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Princesa';
        $pet->kind = 'Dog';
        $pet->weight = 7;
        $pet->age = 14;
        $pet->breed = 'Pincher';
        $pet->location = 'Colombia';
        $pet->description = 'Tiene cataratas en los ojos';
        $pet->save();

    }
}
