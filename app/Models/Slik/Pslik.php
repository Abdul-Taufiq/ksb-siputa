<?php

namespace App\Models\Slik;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pslik extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_slik';
    protected $dates = [
        'created_at', 'updated_at', 'tgl_status_pincab',
        'tgl_status_sdm', 'tgl_status_dirops', 'tgl_status_akhir', 'tgl_status_tsi'
    ];
    protected $primaryKey = 'id_slik';
    protected $guarded = ['id_slik'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
