<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareBiaya extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_share_biaya';
    protected $dates = ['created_at', 'updated_at', 'tgl_transaksi'];
    protected $primaryKey = 'id';
}
