<?php

namespace Database\Factories;

use App\Modules\Documentacion\Models\OficinaPartes\MvSolIngDocumentoArchivo;
use Illuminate\Database\Eloquent\Factories\Factory;

class MvSolIngDocumentoArchivoFactory extends Factory
{
    protected $model = MvSolIngDocumentoArchivo::class;

    public function definition()
    {
        return [
            'ID' => $this->faker->randomNumber(),
            'FOLIO' => $this->faker->randomNumber(5),
            'FOLIO_ADJUNTO' => $this->faker->randomNumber(5),
            // Continúa con los demás campos...
        ];
    }
}