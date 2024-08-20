<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_perfiles extends Model
{
    use HasFactory;
    protected $table = "tbl_perfiles"; 
    protected $primaryKey = 'id_perfil';
    protected $fillable = ['perfil'];
    public $timestamps = false;
}
