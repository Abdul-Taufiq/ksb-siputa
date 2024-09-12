<?php

namespace App\Models\Inventaris;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisPenjualan extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_pengajuan_inventaris_penjualan';
    protected $primaryKey = 'id_inventaris_penjualan';
    protected $dates = [
        'created_at',
        'updated_at',
        'tgl_status_pincab',
        'tgl_status_pembukuan',
        'tgl_status_dirops',
        'tgl_status_akhir',
        'tgl_status_tsi'
    ];
    protected $guarded = ['id_inventaris_penjualan'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function penawar()
    {
        return $this->hasMany(InventarisPenjualanPenawar::class, 'id_inventaris_penjualan', 'id_inventaris_penjualan');
    }
}
