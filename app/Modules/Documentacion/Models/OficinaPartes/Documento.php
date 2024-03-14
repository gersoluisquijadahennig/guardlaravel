<?php
namespace App\Modules\Documentacion\Models\OficinaPartes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table = 'BIBLIOTECA_VIRTUAL.DOCUMENTO';
    protected $primaryKey = 'ID';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'NOMBRE_ARCHIVO',
        'DESCRIPCION',
        'FECHA_DOCUMENTO',
        'FECHA_RECEPCION',
        'FECHA_SUBIDA',
        'FECHA_VENCIMIENTO',
        'IMPRESION',
        'TIPO_DOCUMENTO_ID',
        'TIPO_ACCESO',
        'ORIGEN_ID',
        'ACTIVO',
        'USUARIO_ID_MOD',
        'REFERENCIA_ID',
        'AREA_ID',
        'ESTABLECIMIENTO_ID',
        'DESTINO_ID',
        'FOLIO',
        'PERSONA_ORIGEN',
        'ID_PERTENENCIA_USUARIO',
        'USUARIO_DEPENDENCIA_ESTAB_ID',
        'USUARIO_ID_MOD_ARCHIVO',
        'FECHA_MOD_ARCHIVO'
    ];

    protected $casts = [
        'FECHA_DOCUMENTO' => 'datetime',
        'FECHA_RECEPCION' => 'datetime',
        'FECHA_SUBIDA' => 'datetime',
        'FECHA_VENCIMIENTO' => 'datetime',
        'FECHA_MOD_ARCHIVO' => 'datetime',
    ];


}