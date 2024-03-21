<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Modules\Documentacion\Models\OficinaPartes\MvSolIngDocumento;

class MvSolIngDocumentoFactory extends Factory
{
    protected $model = MvSolIngDocumento::class;

    public function definition()
    {
        return [
            'RUT_RESPONSABLE' => $this->faker->randomNumber(9),
            'NOMBRE_RESPONSABLE' => $this->faker->name,
            'CORREO_RESPONSABLE' => $this->faker->unique()->safeEmail,
            'TELEFONO_FIJO_RESPONSABLE' => $this->faker->phoneNumber,
            'TELEFONO_MOVIL_RESPONSABLE' => $this->faker->phoneNumber,
            'FOLIO' => $this->faker->randomNumber(5),
            'ORIGEN_ID' => $this->faker->randomNumber(3),
            'DOCUMENTO_ID' => $this->faker->randomNumber(3),
            'OBSERVACION_EXTERNA' => $this->faker->sentence,
            'OBSERVACION_CIERRE' => $this->faker->sentence,
            'ESTADO_ID' => $this->faker->randomNumber(3),
            // Continúa con los demás campos...
        ];
    }
}