<?php

namespace App\Imports;
use App\Models\Pet;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class PetsImport implements ToModel
{
	public function model(array $row)
	{
		return new Pet([
			'document'  => $row[0],
			'fullname'  => $row[1],
			'gender'    => $row[2],
			'birthdate' => $row[3],
			'phone'     => $row[4],
			'email'     => $row[5],
			'password'  => Hash::make($row[6]),
		]);
	}
}
