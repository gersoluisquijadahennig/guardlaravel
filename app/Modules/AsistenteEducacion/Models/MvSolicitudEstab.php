<?php
namespace App\Modules\AsistenteEducacion\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MvSolicitudEstab extends Model
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = env('DB_CONNECTION_DEFAULT');
    }

    protected $table = 'ASISTENTE_EDUCACION.MV_SOLICITUD_ESTAB';
    protected $primaryKey = 'ID';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'ESTADO_ID',
        'NOMBRE_ESTAB',
        'RUT_ESTAB',
        'RBD_ESTAB',
        'DIRECCION_ESTAB',
        'TELEFONO_ESTAB',
        'RUT_DIRECTOR',
        'NOMBRE_DIRECTOR',
        'APELLIDO_PAT_DIRECTOR',
    ];

    const CREATED_AT = 'FECHA_CREA';
    const UPDATED_AT = 'FECHA_MOD';

    public function estado()
    {
        return $this->belongsTo('App\Modules\AsistenteEducacion\Models\TbEstado', 'ESTADO_ID', 'ID');
    }
    public function usuarioCrea()
    {
        return $this->belongsTo('App\Modules\AsistenteEducacion\Models\TbUsuario', 'USUARIO_CREA_ID', 'ID');
    }
    public function usuarioMod()
    {
        return $this->belongsTo('App\Modules\AsistenteEducacion\Models\TbUsuario', 'USUARIO_MOD_ID', 'ID');
    }
}