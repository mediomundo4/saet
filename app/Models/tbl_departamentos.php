<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_departamentos extends Model
{
    use HasFactory;
    protected $table = 'tbl_departamentos';
    protected $primaryKey = 'id_departamento';
    protected $fillable = ['id_dependencia','departamento'];
    public $timestamps = false;
}
