<?php

namespace App\Models\TSI;

use App\Models\Cabang;
use App\Models\Inventaris\BarangBaruPengganti;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeliharaan extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_pemeliharaan';
    protected $dates = [
        'created_at', 'updated_at', 'tgl_status_akhir', 'tgl_status_tsi'
    ];
    protected $primaryKey = 'id_pemeliharaan';

    protected $guarded = ['id_pemeliharaan'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function Barang()
    {
        return $this->hasMany(Barang::class, 'id_pemeliharaan', 'id_pemeliharaan');
    }

    public function PemeliharaanHistory()
    {
        return $this->hasMany(PemeliharaanHistory::class, 'id_pemeliharaan', 'id_pemeliharaan');
    }
}
