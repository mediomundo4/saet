<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_modelos extends Model
{
    use HasFactory;
    protected $table = 'tbl_modelos';
    protected $primaryKey = 'id_modelo';
    protected $fillable = ['id_marca', 'modelo', 'id_tipo_equipo'];
    public $timestamps = false;
}
