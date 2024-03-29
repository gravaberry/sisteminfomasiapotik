<?php

namespace Database\Factories;

use App\Models\Suplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Suplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->companyprefix.'.'.$this->faker->lastName(),
            'telp' => '08'.mt_rand(1000000000,9999999999),
            'email' => $this->faker->unique()->safeEmail(),
            'rekening' => mt_rand(100000000000000,999999999999999),
            'alamat' => $this->faker->streetAddress().'-'.$this->faker->city().'-'.$this->faker->postcode().'-'.$this->faker->stateAbbr,
        ];
    }
}
