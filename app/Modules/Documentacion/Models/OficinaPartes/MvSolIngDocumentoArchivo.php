<?php

namespace App\Modules\Documentacion\Models\OficinaPartes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MvSolIngDocumentoArchivo extends Model
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = env('DB_CONNECTION_DEFAULT', 'oracle');
    }
    protected $table = 'BIBLIOTECA_VIRTUAL.MV_SOL_ING_DOCUMENTO_ARCHIVO';
    protected $primaryKey = 'ID';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'FOLIO',
        'FOLIO_ADJUNTO',
        'MV_SOL_ING_DOCUMENTO_ID',
        'DESCRIPCION',
        'ACTIVO',
        'FECHA_CREA',
        'IP_CREA',
        'SERVIDOR_CREA',
        'FECHA_MOD',
        'IP_MOD',
        'SERVIDOR_MOD',
        'FOLIO_SUBIDA',
        'DOCUMENTO_INTERNO',
        'RUTA_DOC_INTERNO',
        'GENERADOS_ID',
        'USUARIO_CREA_ID'
    ];

    protected $casts = [
        'FECHA_CREA' => 'datetime',
        'FECHA_MOD' => 'datetime',
    ];

    const CREATED_AT = 'FECHA_CREA';
    const UPDATED_AT = 'FECHA_MOD';

    public function mvSolIngDocumento()
    {
        return $this->belongsTo(MvSolIngDocumento::class, 'MV_SOL_ING_DOCUMENTO_ID', 'ID');
    }
}