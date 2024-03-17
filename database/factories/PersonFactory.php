<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;

class PersonFactory extends Factory
{       

    protected $model = Person::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "firstname"=>  $this->faker->firstName(),
            "lastname"=>  $this->faker->lastName(),
            "birth_date" =>  $this->faker->date(),
            "gender"  =>  $this->faker->randomElement(['M', 'F']),
            "email"  =>  $this->faker->unique()->safeEmail()
        ];
    }
}
