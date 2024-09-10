<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_procesadores extends Model
{
    use HasFactory;
    protected $table = 'tbl_procesadores';
    protected $primaryKey = 'id_procesador';
    protected $fillable = ['procesador'];
    public $timestamps = false;
}
