<?php

namespace App\Models\Inventaris;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisPenjualanPenawar extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_pengajuan_inventaris_penjualan_penawar';
    protected $primaryKey = 'id_penawar';
    protected $dates = [
        'created_at',
        'updated_at',
        'tgl_status_pincab',
        'tgl_status_pembukuan',
        'tgl_status_dirops',
        'tgl_status_akhir',
        'tgl_status_tsi'
    ];
    protected $guarded = ['id_penawar'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function inventarisPenjualan()
    {
        return $this->belongsTo(InventarisPenjualan::class, 'id_inventaris_penjualan', 'id_inventaris_penjualan');
    }
}
