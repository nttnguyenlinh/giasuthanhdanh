<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\KhuVuc;
class TinhThanh extends Model
{
    protected $table = 'tinh_thanh';
    protected $fillable = ['tentinh'];
    public $timestamps = false;

    public function khu_vuc()
    {
        return $this->hasMany(KhuVuc::class);
    }
}
