<?php

namespace App\Modules\Documentacion\Models\OficinaPartes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'BIBLIOTECA_VIRTUAL.ESTADO';
    protected $primaryKey = 'ID';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'CODIGO',
        'DESCRIPCION',
        'ACTIVO',
        'USUARIO_ID_MOD',
        'FECHA_MOD'
    ];

    protected $casts = [
        'FECHA_MOD' => 'datetime',
    ];

    const CREATED_AT = 'FECHA_MOD';
    const UPDATED_AT = 'FECHA_MOD';

    
}