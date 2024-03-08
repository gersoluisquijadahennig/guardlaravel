<?php

namespace App\Modules\Documentacion\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListadoPoliticasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            'politica_id' => $this->politica_id,
            'detalle' => $this->only([
                'politica_version_id',
                'politica_version_estab_id',
                'nombre',
                'descripcion',
                'dependencia_establecimiento_id',
                'version',
                'ruta_archivo',
                'tipo_politica',
                'comprobante',
                'archivo_comprobante',
                'tb_tipo_correo_id',
                'establecimiento_id',
                'usuario_politica_id',
                'dia_crea',
                'hora_crea',
                'alcance',
                'politica_externa',
                'politica_interna',
                'notifica_correo',
                'firmado',
            ]),
        ];
    }
}
