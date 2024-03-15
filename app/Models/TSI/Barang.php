<?php

namespace App\Models\TSI;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_barang_elektronik';
    protected $dates = [
        'created_at', 'updated_at', 'tgl_pembelian'
    ];
    protected $primaryKey = 'id_barang_elektronik';

    protected $guarded = ['id_barang_elektronik'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function Pemeliharaan()
    {
        return $this->belongsTo(Pemeliharaan::class, 'id_pemeliharaan', 'id_pemeliharaan');
    }
}
