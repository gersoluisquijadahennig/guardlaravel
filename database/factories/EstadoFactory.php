<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Modules\Documentacion\Models\OficinaPartes\Estado;


class EstadoFactory extends Factory
{
    protected $model = Estado::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->state,
            // Agrega aquí otros campos de la tabla estado
        ];
    }
}