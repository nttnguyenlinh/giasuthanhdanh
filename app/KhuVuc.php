<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TinhThanh;
class KhuVuc extends Model
{
    protected $table = 'khu_vuc';
    protected $fillable = ['tenkv', 'matinh'];
    public $timestamps = false;

    public function tinh_thanh()
    {
        return $this->belongsTo(TinhThanh::class);
    }
}
