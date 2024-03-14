<?php

namespace App\Modules\Documentacion\Models\OficinaPartes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Origen extends Model
{
    use HasFactory;
    protected $connection = 'oracle';
    protected $table = 'BIBLIOTECA_VIRTUAL.ORIGEN'; 
    protected $primaryKey = 'ID'; 
    public $incrementing = false; 
    public $timestamps = false; 

    protected $fillable = [
        'ID',
        'DESCRIPCION',
        'ACTIVO',
        'LUGAR',
        'CODIGO',
    ];
}