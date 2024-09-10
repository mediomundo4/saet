<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_tipos_equipos extends Model
{
    use HasFactory;
    protected $table = 'tbl_tipos_equipos';
    protected $primaryKey = 'id_tipo_equipo';
    protected $fillable = ['tipo_equipo'];
    public $timestamps = false;
}
