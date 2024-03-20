<?php

namespace App\Modules\Documentacion\Models\OficinaPartes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MvSolIngDocumentoDestino extends Model
{
    use HasFactory;

    protected $table = 'BIBLIOTECA_VIRTUAL.MV_SOL_ING_DOCUMENTO_DESTINO';
    protected $primaryKey = 'ID';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'MV_SOL_ING_DOCUMENTO_ID',
        'ESTABLECIMIENTO_ID',
        'DESTINO',
        'ACTIVO',
        'FECHA_CREA',
        'IP_CREA',
        'SERVIDOR_CREA',
        'FECHA_MOD',
        'IP_MOD',
        'SERVIDOR_MOD'
    ];


    const CREATED_AT = 'FECHA_CREA';
    const UPDATED_AT = 'FECHA_MOD';

    public function mvSolIngDocumento()
    {
        return $this->belongsTo(MvSolIngDocumento::class, 'MV_SOL_ING_DOCUMENTO_ID', 'ID');
    }
}