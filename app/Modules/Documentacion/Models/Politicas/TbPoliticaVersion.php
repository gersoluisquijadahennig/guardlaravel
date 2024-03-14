<?php

namespace App\Modules\Documentacion\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbPoliticaVersion extends Model
{
    protected $connection = 'oracle';
    protected $table = 'BIBLIOTECA_VIRTUAL.TB_POLITICA_VERSION';
    protected $primaryKey = 'ID';
    public $timestamps = false; // Si no necesitas timestamps

    protected $fillable = [
        'TB_POLITICA_ID',
        'ACTIVO',
        'VERSION',
        'COMPROBANTE',
        'TIPO_POLITICA',
        'RUTA_ARCHIVO',
        'ARCHIVO_COMPROBANTE',
        'NOTIFICA__CORREO',
        'FECHA_CREA',
        'USUARIO_CREA_ID',
        'IP_CREA',
        'SERVIDOR_CREA',
        'PERSONAS_CREA',
        'FECHA_MOD',
        'USUARIO_MOD_ID',
        'IP_MOD',
        'SERVIDOR_MOD',
        'PERSONAS_MOD',
        'TB_TIPO_CORREO_ID',
        'POLITICA_INTERNA',
        'POLITICA_EXTERNA',
        'ALCANCE',
    ];

    const CREATED_AT = 'FECHA_CREA';
    const UPDATED_AT = 'FECHA_MOD';

    public function tbPolitica()
    {
        return $this->belongsTo(TbPolitica::class, 'TB_POLITICA_ID', 'ID');
    }

    public function tbTipoCorreo()
    {
        return $this->belongsTo(TbTipoCorreo::class, 'TB_TIPO_CORREO_ID', 'ID');
    }

    public function usuariosPolitica()
    {
        return $this->hasMany(MVUsuarioPolitica::class, 'ESTABLECIMIENTO_ID', 'ID');
    }

    public function versiones()
{
    return $this->hasMany(TbPoliticaVersion::class, 'TB_POLITICA_ID');
}
}