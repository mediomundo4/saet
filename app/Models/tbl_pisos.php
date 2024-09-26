<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_pisos extends Model
{
    use HasFactory;
    protected $table = 'tbl_pisos';
    protected $primaryKey = 'id_piso';
    protected $fillable = ['piso'];
    public $timestamps = false;
}
