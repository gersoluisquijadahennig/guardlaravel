<?php
namespace App\Modules\Documentacion\Models\OficinaPartes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MvSolIngDocumento extends Model
{
    use SoftDeletes;

    protected $connection = 'oracle';
    protected $table = 'BIBLIOTECA_VIRTUAL.MV_SOL_ING_DOCUMENTO';
    protected $primaryKey = 'ID';
    public $incrementing = false;
    public $timestamps = true;// por ahora false

    protected $fillable = [
        'RUT_RESPONSABLE',
        'NOMBRE_RESPONSABLE',
        'CORREO_RESPONSABLE',
        'TELEFONO_FIJO_RESPONSABLE',
        'TELEFONO_MOVIL_RESPONSABLE',
        'FOLIO',
        'ORIGEN_ID',
        'DOCUMENTO_ID',
        'OBSERVACION_EXTERNA',
        'OBSERVACION_CIERRE',
        'ESTADO_ID',
        'CLAVE_UNICA_CREA',
        'FECHA_CREA',
        'IP_CREA',
        'SERVIDOR_CREA',
        'CLAVE_UNICA_MOD',
        'FECHA_MOD',
        'IP_MOD',
        'SERVIDOR_MOD',
        'TOKEN_CREA',
        'DOC_DIGITAL',
        'MV_DOCUMENTO_GENERADO_ID'
    ];

    const CREATED_AT = 'FECHA_CREA';
    const UPDATED_AT = 'FECHA_MOD';
    
    public function documento()
    {
        return $this->belongsTo(Documento::class, 'DOCUMENTO_ID');
    }

    public function origen()
    {
        return $this->belongsTo(Origen::class, 'ORIGEN_ID');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'ESTADO_ID');
    }

    public function destinos()
    {
        return $this->hasMany(MvSolIngDocumentoDestino::class, 'MV_SOL_ING_DOCUMENTO_ID', 'id');
    }

    public function archivos()
    {
        return $this->hasMany(MvSolIngDocumentoArchivo::class, 'MV_SOL_ING_DOCUMENTO_ID', 'id');
    }
}