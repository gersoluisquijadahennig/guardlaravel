<?php

namespace App\Modules\Documentacion\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TbTipoCorreo extends Model
{
    protected $table = 'TB_TIPO_CORREO';
    protected $primaryKey = 'ID';
    public $timestamps = false; // Si no necesitas timestamps

    protected $fillable = [
        'DESCRIPCION',
        'ACTIVO',
        'FECHA_CREA',
        'USUARIO_CREA_ID',
        'IP_CREA',
        'SERVIDOR_CREA',
        'ESTABLECIMIENTO_CREA',
        'FECHA_MOD',
        'USUARIO_MOD_ID',
        'IP_MOD',
        'SERVIDOR_MOD',
        'ESTABLECIMIENTO_MOD',
    ];

    protected $casts = [
        'FECHA_CREA' => 'date',
        'FECHA_MOD' => 'date',
    ];

    protected $hidden = [
        'ESTABLECIMIENTO_CREA',
        'ESTABLECIMIENTO_MOD',
    ];

    public function usuarioCrea()
    {
        return $this->belongsTo(User::class, 'USUARIO_CREA_ID', 'ID');
    }

    public function usuarioMod()
    {
        return $this->belongsTo(User::class, 'USUARIO_MOD_ID', 'ID');
    }
}