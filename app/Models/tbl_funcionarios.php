<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_funcionarios extends Model
{
    use HasFactory;
    protected $table = "tbl_funcionarios"; 
    protected $primaryKey = 'id_funcionario';
    protected $fillable = ['nombrefun', 'apellidofun', 'cedulafun','usuario_dominio', 'correo_personal', 'correo_inst', 'telefono'];
    public $timestamps = false;
}
