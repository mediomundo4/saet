<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_parroquias extends Model
{
    use HasFactory;
    protected $table = 'tbl_parroquias';
    protected $primaryKey = 'id_parroquia';
    protected $fillable = ['id_municipio','parroquia'];
    public $timestamps = false;
}
