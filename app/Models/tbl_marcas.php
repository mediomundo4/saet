<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_marcas extends Model
{
    use HasFactory;
    protected $table = 'tbl_marcas';
    protected $primaryKey = 'id_marca';
    protected $fillable = ['marca'];
    public $timestamps = false;
}
