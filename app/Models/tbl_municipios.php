<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_municipios extends Model
{
    use HasFactory;
    protected $table = 'tbl_municipios';
    protected $primaryKey = 'id_municipio';
    protected $fillable = ['id_estado','municipio'];
    public $timestamps = false;
}
