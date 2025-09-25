<?php

namespace App\Models\Pembatalan;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antarkantor extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_pembatalan_antar_kantor';
    protected $primaryKey = 'id_antar_kantor';
    protected $dates = [
        'tgl_status_pincab',
        'tgl_status_pembukuan',
        'tgl_status_dirops',
        'tgl_status_akhir',
        'created_at',
        'updated_at',
        'tgl_status_dirut'
    ];

    protected $guarded = ['id_antar_kantor'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
