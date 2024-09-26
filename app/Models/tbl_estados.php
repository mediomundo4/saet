<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_estados extends Model
{
    use HasFactory;
    protected $table = 'tbl_estados';
    protected $primaryKey = 'id_estado';
    protected $fillable = ['id_region','estado'];
    public $timestamps = false;
}
