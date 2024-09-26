<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_regiones extends Model
{
    use HasFactory;
    protected $table = 'tbl_regiones';
    protected $primaryKey = 'id_region';
    protected $fillable = ['region'];
    public $timestamps = false;
}
