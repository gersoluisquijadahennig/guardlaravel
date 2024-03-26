<?php

namespace App\Modules\AsistenteEducacion\Models;

use Illuminate\Database\Eloquent\Model;

class MvEstablecimiento extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = env('DB_CONNECTION_DEFAULT');
    }

    protected $table = 'ASISTENTE_EDUCACION.MV_ESTABLECIMIENTO';
    protected $primaryKey = 'ID';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'NOMBRE',
        'RUT',
        'RBD',
        'DIRECCION',
        'TELEFONO',
        'EMAIL',
        'N_CELULAR',
        'ACTIVO',
    ];

    public function solicitud()
    {
        return $this->hasMany(MvSolicitudEstab::class, 'ESTABLECIMIENTO_ID', 'ID');
    }   
}