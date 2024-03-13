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
            'detalle' => [
                'politica_version_id' => $this->politica_version_id,
                'politica_version_estab_id' => $this->politica_version_estab_id,
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'dependencia_establecimiento_id' => $this->dependencia_establecimiento_id,
                'version' => $this->version,
                'ruta_archivo' => $this->ruta_archivo,
                'tipo_politica' => $this->tipo_politica,
                'comprobante' => $this->comprobante,
                'archivo_comprobante' => $this->archivo_comprobante,
                'tb_tipo_correo_id' => $this->tb_tipo_correo_id,
                'establecimiento_id' => $this->establecimiento_id,
                'usuario_politica_id' => $this->usuario_politica_id,
                'dia_crea' => $this->dia_crea,
                'hora_crea' => $this->hora_crea,
                'alcance' => $this->alcance,
                'politica_externa' => $this->politica_externa,
                'politica_interna' => $this->politica_interna,
                'notifica_correo' => $this->notifica_correo,
                'firmado' => $this->firmado,
            ],
        ];
    }
}
