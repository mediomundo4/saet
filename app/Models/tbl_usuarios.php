<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_usuarios extends Model
{
    use HasFactory;
    protected $table = "tbl_usuarios"; 
    protected $primaryKey = 'id_usuario';
    protected $fillable = ['nombre', 'apellido', 'cedula','usuario', 'clave', 'correo','id_perfil','ruta_foto'];
    public $timestamps = false;
}

