<?php

namespace App\Modules\Documentacion\Models\Politicas;

use Illuminate\Database\Eloquent\Model;
use App\Models\PanelUser;

class MVUsuarioPolitica extends Model
{
    protected $connection = 'oracle';
    protected $table = 'BIBLIOTECA_VIRTUAL.MV_USUARIO_POLITICA';
    protected $primaryKey = 'ID';
    public $timestamps = false; // Si no tienes columnas 'created_at' y 'updated_at'
    // Resto de las columnas en la tabla
    protected $fillable = [
        'TB_POLITICA_VERSION_ID',
        'ACEPTA',
        'USUARIO_ID',
        'RUT_FUNCIONARIO',
        'NOMBRE_FUNCIONARIO',
        'ENVIO_CORREO',
        'EMAIL',
        'CODIGO_VERIFICACION',
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
        'MV_RUT_SERVICIO_ID',
        'CARGO',
        'FIRMADO',
        'ESTABLECIMIENTO_ID',
        'ACTIVO',
    ];

    
    // Relación con la tabla ESTABLECIMIENTO
    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'ESTABLECIMIENTO_ID', 'ID');
    }

    // Relación con la tabla TB_POLITICA_VERSION
    public function politicaVersion()
    {
        return $this->belongsTo(TBPoliticaVersion::class, 'TB_POLITICA_VERSION_ID', 'ID');
    }

    // Relación con la tabla MV_RUT_SERVICIO
    public function rutServicio()
    {
        return $this->belongsTo(MVRutServicio::class, 'MV_RUT_SERVICIO_ID', 'ID');
    }

    // Relación con la tabla USUARIO_PANEL
    public function usuario()
    {
        return $this->belongsTo(PanelUser::class, 'USUARIO_CREA_ID', 'ID');
    }
}

class Establecimiento extends Model
{
    protected $table = 'ESTABLECIMIENTO';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    
    // Resto de las columnas en la tabla
}


class MVRutServicio extends Model
{
    protected $table = 'MV_RUT_SERVICIO';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    // Resto de las columnas en la tabla
}

