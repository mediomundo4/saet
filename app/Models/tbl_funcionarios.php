<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_funcionarios extends Model
{
    use HasFactory;
    protected $table = "tbl_funcionarios"; 
    protected $primaryKey = 'id_funcionario';
    protected $fillable = ['nombrefun', 'apellidofun', 'cedulafun','usuario_dominio', 'correo_personal', 'correo_inst', 'telefono','id_dependencia','id_departamento','id_piso','id_cargo'];
    public $timestamps = false;
    
}
