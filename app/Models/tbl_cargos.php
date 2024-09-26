<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_cargos extends Model
{
    use HasFactory;
    protected $table = 'tbl_cargosv';
    protected $primaryKey = 'id_cargoa';
    protected $fillable = ['cargo'];
    public $timestamps = false;
}
