<?php

namespace App\Models\Inventaris;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisPengganti extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_pengajuan_inventaris_pengganti';
    protected $dates = [
        'created_at',
        'updated_at',
        'tgl_status_pincab',
        'tgl_status_pembukuan',
        'tgl_status_dirops',
        'tgl_status_akhir',
        'tgl_status_tsi',
        'tgl_pembelian'
    ];
    protected $primaryKey = 'id_inventaris_pengganti';

    protected $guarded = ['id_inventaris_pengganti'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function BarangBaruPengganti()
    {
        return $this->hasMany(BarangBaruPengganti::class, 'id_inventaris_pengganti', 'id_inventaris_pengganti');
    }

    public function diganti()
    {
        return $this->hasMany(Diganti::class, 'id_inventaris_pengganti', 'id_inventaris_pengganti');
    }
}
