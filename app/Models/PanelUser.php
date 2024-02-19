<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelUser extends Model implements Authenticatable
{
    use HasFactory;
    
    protected $guard = 'custom';
    
    protected $connection = 'oracle';

    protected $table = 'BIBLIOTECA_VIRTUAL.USUARIO_PANEL';

    

    protected $fillable = [
        'id',
        'usuario',
        'clave',
        'personas_id',
        'perfil_id',
        'correo_electronico',
        'fecha_ingreso',
        'descripcion',
        'activo',
        'usuario_id_mod',
        'establecimiento_id',
        'estab_unid_func_id',
        'unidad_funcional_origen_id',
        'proyecto_predeterminado',
        'alias',
        'run',
        'ultimo_acceso',
        'habilita_depuracion',
        'fecha_clave',
    ];

    protected $hidden = [
        'clave',
    ];
    
    /*
    protected $casts = [
        'fecha_ingreso' => 'date',
        'fecha_clave' => 'date',
    ];
    */


    /**
     * Implementación de Authenticatable
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }
    /**
     * recupera el valor de password de la base de datos
     */
    public function getAuthPassword()
    {
        return $this->clave;
    }

    protected function convertirMD5aTextoPlano($md5Password){

    }

    public function getRememberToken()
    {
        // Puedes dejar este método vacío si no usas remember_token en tu base de datos
    }

    public function setRememberToken($value)
    {
        // Puedes dejar este método vacío si no usas remember_token en tu base de datos
    }

    public function getRememberTokenName()
    {
        // Puedes dejar este método vacío si no usas remember_token en tu base de datos
    }

}
