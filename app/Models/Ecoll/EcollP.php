<?php

namespace App\Models\Ecoll;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcollP extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_ecoll_p';
    protected $dates = [
        'created_at',
        'updated_at',
        'aktif',
        'non_aktif',
        'tgl_status_pincab',
        'tgl_status_sdm',
        'tgl_status_dirops',
        'tgl_status_akhir',
        'tgl_status_tsi',
        'tgl_status_dirut'
    ];
    protected $primaryKey = 'id_ecoll_p';
    protected $guarded = ['id_ecoll_p'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
