<?php

namespace App\Modules\Documentacion\Models;

use Illuminate\Database\Eloquent\Model;

class TbPoliticaVersionEstab extends Model
{
    protected $connection = 'oracle';
    protected $table = 'TB_POLITICA_VERSION_ESTAB';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'TB_POLITICA_VERSION_ID',
        'ACTIVO',
        'ESTABLECIMIENTO_ID',
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

    public function politicaVersion()
    {
        return $this->belongsTo(TbPoliticaVersion::class, 'TB_POLITICA_VERSION_ID', 'ID');
    }
}
