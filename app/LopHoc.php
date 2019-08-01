<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LopHoc extends Model
{
    protected $table = 'lop_hoc';
    protected $fillable = ['tenlop', 'khoilop'];
    public $timestamps = false;
}
