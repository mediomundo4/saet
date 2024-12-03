<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_inventarios extends Model
{
    use HasFactory;
    protected $table = "tbl_inventarios_equipos"; 
    protected $primaryKey = 'id_invequipo';
    protected $fillable = ['id_modelo','id_procesador','memoria','id_unidad_disco','id_sistema','fecha_invequipo','nserial','bien_nacional'];
    public $timestamps = false;
}