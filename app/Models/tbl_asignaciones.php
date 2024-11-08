<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_asignaciones extends Model
{
    use HasFactory;
    protected $table = 'tbl_asignaciones';
    protected $primaryKey = 'id_asignacion';
    protected $fillable = ['id_funcionario', 'id_invequipo', 'fecha_asignacion', 'cantidad__asignacion','usuario'];
    public $timestamps = false;
}
