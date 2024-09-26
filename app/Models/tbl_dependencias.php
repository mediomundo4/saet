<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_dependencias extends Model
{
    use HasFactory;
    protected $table = 'tbl_dependencias';
    protected $primaryKey = 'id_dependencia';
    protected $fillable = ['dependencia'];
    public $timestamps = false;
}
