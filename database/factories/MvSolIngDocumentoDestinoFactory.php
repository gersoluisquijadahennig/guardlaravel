<?php

namespace Database\Factories;

use App\Modules\Documentacion\Models\OficinaPartes\MvSolIngDocumentoDestino;
use Illuminate\Database\Eloquent\Factories\Factory;

class MvSolIngDocumentoDestinoFactory extends Factory
{
    protected $model = MvSolIngDocumentoDestino::class;

    public function definition()
    {
        return [
            'ID' => $this->faker->randomNumber(),
            'MV_SOL_ING_DOCUMENTO_ID' => $this->faker->randomNumber(),
            'ESTABLECIMIENTO_ID' => $this->faker->randomNumber(),
            'DESTINO' => $this->faker->word,
            'ACTIVO' => $this->faker->boolean,
            'FECHA_CREA' => $this->faker->dateTime(),
            'IP_CREA' => $this->faker->ipv4,
            'SERVIDOR_CREA' => $this->faker->word,
            'FECHA_MOD' => $this->faker->dateTime(),
            'IP_MOD' => $this->faker->ipv4,
            'SERVIDOR_MOD' => $this->faker->word,
            // Continúa con los demás campos...
        ];
    }
}