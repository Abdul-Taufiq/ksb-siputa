<?php

namespace App\Models\Pembatalan;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_pembatalan_inventaris';
    protected $primaryKey = 'id_inventaris';
    protected $dates = [
        'tgl_status_pincab',
        'tgl_status_pembukuan',
        'tgl_status_tsi',
        'tgl_status_dirops',
        'tgl_status_akhir',
        'created_at',
        'updated_at',
        'tgl_status_dirut'
    ];

    protected $guarded = ['id_inventaris'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
