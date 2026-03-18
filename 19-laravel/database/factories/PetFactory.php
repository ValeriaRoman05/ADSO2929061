<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pet_names = array('Max','Luna','Rocky','Bella','Toby','Coco','Bruno','Daisy','Rex','Maya','Misi','Salem','Oliver','Nala','Simba','Pelusa','Tom','Garfield','Sasha','Pepa','Babe','Rosita','Oink','Gordi','Ham','Puerqui','Waddles','Pua','Bacon','Jerry','Mickey','Quesito','Stuart','Pinky','Cerebro','Burbuja','Sniff','Remy','Speedy');
        $Dog   = array('Golden Retriever', 'German Shepherd', 'Bulldog', 'Beagle', 'Poodle');
        $Cat   = array('Siamese', 'Persian', 'Maine Coon', 'Bengal', 'Sphynx');
        $Pig   = array('Berkshire', 'Tamworth', 'Hampshire', 'Duroc', 'Vietnamese Potbelly');
        $Mouse = array('Fancy Mouse', 'Albino', 'Spiny Mouse', 'Zebra Mouse', 'Wood Mouse');

        $kind = array('Dog', 'Cat', 'Pig', 'Mouse');
        $selectedKind = fake()->randomElement($kind);
        $name = fake()->randomElement($pet_names);
        switch ($selectedKind) {
            case 'Dog':
                $breed = fake()->randomElement($Dog);
                break;
            case 'Cat':
                $breed = fake()->randomElement($Cat);
                break;
            case 'Pig':
                $breed = fake()->randomElement($Pig);
                break;
            case 'Mouse':
                $breed = fake()->randomElement($Mouse);
                break;
            default:
                $breed = 'Unknown';
                break;
        }
        return [
            //
            'name' => $name,
            'kind' => $selectedKind,
            'weight' => fake()->numerify('#.#'),
            'age' => fake()->numberBetween(1, 20),
            'breed' => $breed,
            'location' => fake()->city,
            'description' => fake()->sentence(5),
        ];
    }
}
