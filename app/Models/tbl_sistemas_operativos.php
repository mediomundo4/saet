<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_sistemas_operativos extends Model
{
    use HasFactory;
    protected $table = 'tbl_sistemas_operativos';
    protected $primaryKey = 'id_sistema_operativo';
    protected $fillable = ['sistema_operativo'];
    public $timestamps = false;
}
