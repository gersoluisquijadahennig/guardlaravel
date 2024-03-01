<?php

namespace App\Modules\Documentacion\Models;

use Illuminate\Database\Eloquent\Model;

class TbPolitica extends Model
{
    protected $connection = 'oracle';
    
    protected $table = 'BIBLIOTECA_VIRTUAL.TB_POLITICA'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'ID'; // Nombre de la clave primaria

    protected $fillable = [
        'ID',
        'NOMBRE',
        'DESCRIPCION',
        'ACTIVO',
        'DEPENDENCIA_ESTABLECIMIENTO_ID',
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
    ];

    const CREATED_AT = 'FECHA_CREA';
    const UPDATED_AT = 'FECHA_MOD';

    //public $timestamps = false;


    // Relación con la tabla 'DEPENDENCIA_ESTABLECIMIENTO'
    public function dependenciaEstablecimiento()
    {
        return $this->belongsTo(DependenciaEstablecimiento::class, 'DEPENDENCIA_ESTABLECIMIENTO_ID');
    }
}
