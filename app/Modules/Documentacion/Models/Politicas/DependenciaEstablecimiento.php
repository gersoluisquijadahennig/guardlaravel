<?php

namespace App\Modules\Documentacion\Models;

use Illuminate\Database\Eloquent\Model;

class DependenciaEstablecimiento extends Model
{
    protected $connection = 'oracle';

    protected $table = 'GESTION_CENTRAL.DEPENDENCIA_ESTABLECIMIENTO'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'ID'; // Nombre de la clave primaria

    protected $fillable = [
        'CODIGO',
        'DESCRIPCION',
        'CENTRO_PADRE_ID',
        'ESTADO_ID',
        'USUARIO_ID_MOD',
        'FECHA_MOD',
        'ID_ESTABLECIMIENTO',
        'NOMBRE_CORTO',
        'PROGRAMACION',
        'BODEGA_INTERNA',
        'NIVEL',
        'TIPO_DEPENDENCIA_ID',
        'LAVANDERIA',
        'BODEGA_ID',
        'TB_TIPO_INSTITUCION_SIAPER_ID',
    ];

    // Relación con la tabla 'DEPENDENCIA_ESTABLECIMIENTO' (Centro Padre)
    /*
    public function centroPadre()
    {
        return $this->belongsTo(CentroPadre::class, 'CENTRO_PADRE_ID');
    }

    // Relación con la tabla 'ESTADO'
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'ESTADO_ID');
    }

    // Otras relaciones...

    // Relación con la tabla 'ESTABLECIMIENTO'
    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'ID_ESTABLECIMIENTO');
    }

    // Otras relaciones...

    // Relación con la tabla 'TIPO_DEPENDENCIA'
    public function tipoDependencia()
    {
        return $this->belongsTo(TipoDependencia::class, 'TIPO_DEPENDENCIA_ID');
    }

    // Relación con la tabla 'BODEGA'
    public function bodega()
    {
        return $this->belongsTo(Bodega::class, 'BODEGA_ID');
    }

    // Relación con la tabla 'TB_TIPO_INSTITUCION_SIAPER'
    public function tipoInstitucionSiaper()
    {
        return $this->belongsTo(TbTipoInstitucionSiaper::class, 'TB_TIPO_INSTITUCION_SIAPER_ID');
    }
    */
}
