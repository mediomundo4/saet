<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_unidades_discos extends Model
{
    use HasFactory;
    protected $table = 'tbl_unidades_discos';
    protected $primaryKey = 'id_unidad_disco';
    protected $fillable = ['unidad_disco'];
    public $timestamps = false;
}
