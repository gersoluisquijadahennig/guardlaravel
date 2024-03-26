<?php

namespace App\Modules\AsistenteEducacion\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MvSolicitudCambioDirector extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = env('DB_CONNECTION_DEFAULT', 'oracle');
    }

    protected $primaryKey = 'ID';
    public $incrementing = false;
    public $timestamps = false;

    protected $table = 'ASISTENTE_EDUCACION.MV_SOLICITUD_CAMBIO_DIRECTOR';

    protected $fillable = [
        'ESTABLECIMIENTO_ID',
        'RBD',
        'RUT_SOLICITA',
        'NOMBRE_SOLICITA',
        'APELLIDO_PAT_SOLICITA',
        'APELLIDO_MAT_SOLICITA',
        'EMAIL_SOLICITA',
        'TELEFONO_SOLICITA',
        'CARGO_SOLICITA',
        'RUT_DIRECTOR',
        'NOMBRE_DIRECTOR',
        'APELLIDO_PAT_DIRECTOR',
        'APELLIDO_MAT_DIRECTOR',
        'EMAIL_DIRECTOR',
        'TELEFONO_DIRECTOR',
        'ACTIVO',
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
        'ESTADO_ID',
        'COMENTARIO_RECHAZO'
    ];

    public function establecimiento()
    {
        return $this->belongsTo('App\Models\Modules\AsistenteEducacion\Models\MvEstablecimiento', 'ESTABLECIMIENTO_ID', 'ID');
    }

    public function estado()
    {
        return $this->belongsTo('App\Models\Modules\AsistenteEducacion\Models\TbEstado', 'ESTADO_ID', 'ID');
    }

    public function usuarioCrea()
    {
        return $this->belongsTo('App\Models\Modules\AsistenteEducacion\Models\TbUsuario', 'USUARIO_CREA_ID', 'ID');
    }

    public function usuarioMod()
    {
        return $this->belongsTo('App\Models\Modules\AsistenteEducacion\Models\TbUsuario', 'USUARIO_MOD_ID', 'ID');
    }

    public function personasCrea()
    {
        return $this->belongsTo('App\Models\Modules\AsistenteEducacion\Models\TbPersona', 'PERSONAS_CREA', 'ID');
    }

    public function personasMod()
    {
        return $this->belongsTo('App\Models\Modules\AsistenteEducacion\Models\TbPersona', 'PERSONAS_MOD', 'ID');
    }

    public function getFechaCreaAttribute($value)
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }

    public function getFechaModAttribute($value)
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }

    public function getActivoAttribute($value)
    {
        return $value == 1 ? 'Activo' : 'Inactivo';
    }

    public function getEstadoAttribute($value)
    {
        return $value == 1 ? 'Activo' : 'Inactivo';
    }

    public function getNombreCompletoSolicitaAttribute()
    {
        return $this->NOMBRE_SOLICITA . ' ' . $this->APELLIDO_PAT_SOLICITA . ' ' . $this->APELLIDO_MAT_SOLICITA;
    }

    public function getNombreCompletoDirectorAttribute()
    {
        return $this->NOMBRE_DIRECTOR . ' ' . $this->APELLIDO_PAT_DIRECTOR . ' ' . $this->APELLIDO_MAT_DIRECTOR;
    }

    public function getNombreCompletoUsuarioCreaAttribute()
    {
        return $this->usuarioCrea->persona->NOMBRES . ' ' . $this->usuarioCrea->persona->APELLIDO_PAT . ' ' . $this->usuarioCrea->persona->APELLIDO_MAT;
    }

    public function getNombreCompletoUsuarioModAttribute()
    {
        return $this->usuarioMod->persona->NOMBRES . ' ' . $this->usuarioMod->persona->APELLIDO_PAT . ' ' . $this->usuarioMod->persona->APELLIDO_MAT;
    }

    public function getNombreCompletoPersonaCreaAttribute()
    {
        return $this->personasCrea->NOMBRES . ' ' . $this->personasCrea->APELLIDO_PAT . ' ' . $this->personasCrea->APELLIDO_MAT;
    }

    public function getNombreCompletoPersonaModAttribute()
    {
        return $this->personasMod->NOMBRES . ' ' . $this->personasMod->APELLIDO_PAT . ' ' . $this->personasMod->APELLIDO_MAT;
    }

    public function getEstadoSolicitudAttribute()
    {
        return $this->estado->NOMBRE;
    }

    public function getRutSolicitaAttribute()
    {
        return $this->RUT_SOLICITA;
    }

    public function getRutDirectorAttribute()
    {
        return $this->RUT_DIRECTOR;
    }

    public function getRbdAttribute()
    {
        return $this->RBD;
    }

    public function getTelefonoSolicitaAttribute()
    {
        return $this->TELEFONO_SOLICITA;
    }

    public function getTelefonoDirectorAttribute()
    {
        return $this->TELEFONO_DIRECTOR;
    }

    public function getEmailSolicitaAttribute()
    {
        return $this->EMAIL_SOLICITA;
    }

    public function getEmailDirectorAttribute()
    {
        return $this->EMAIL_DIRECTOR;
    }

    public function getCargoSolicitaAttribute()
    {
        return $this->CARGO_SOLICITA;
    }
}