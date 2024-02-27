<?php

namespace App\Models\Ecoll;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcollR extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_ecoll_r';
    protected $dates = [
        'created_at', 'updated_at', 'aktif', 'non_aktif', 'tgl_status_pincab', 'tgl_status_sdm',
        'tgl_status_dirops', 'tgl_status_akhir', 'tgl_status_tsi'
    ];
    protected $primaryKey = 'id_ecoll_r';
    protected $guarded = ['id_ecoll_r'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
