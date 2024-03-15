<?php

namespace App\Models\TSI;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BantuanTSI extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_bantuan_tsi';
    protected $dates = [
        'created_at', 'updated_at', 'tgl_status_akhir', 'tgl_status_tsi'
    ];
    protected $primaryKey = 'id_bantuan';

    protected $guarded = ['id_bantuan'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
