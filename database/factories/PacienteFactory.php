<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' => $this->faker->name,
            'apellidos' => $this->faker->lastName,
            'di' => $this->faker->unique()->numerify('########'),
            'eps' => $this->faker->name,
            'fecha_nacimiento' => $this->faker->date(format: 'Y/m/d',max: '2020-01-01'),
            'genero' => $this->faker->randomElement(['M','F']),
            'telefono' => $this->faker->phoneNumber,
            'correo' => $this->faker->unique()->safeEmail,
            'direccion' => $this->faker->address,
            'grupo_sanguineo' => $this->faker->randomElement(['A+','A-','B+','B-','O+','O-']),
            'alergias' => $this->faker->words(3, true),
            'contacto_emergencia' => $this->faker->phoneNumber,
            'observaciones' => $this->faker->words(3, true),
        ];
    }
}
