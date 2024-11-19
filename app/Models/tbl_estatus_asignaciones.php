<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_estatus_asignaciones extends Model
{
    use HasFactory;
    protected $table = 'tbl_estatus_asignaciones';
    protected $primaryKey = 'id_estatu_asignacion';
    protected $fillable = ['estatu_asignacion'];
    public $timestamps = false;
}
