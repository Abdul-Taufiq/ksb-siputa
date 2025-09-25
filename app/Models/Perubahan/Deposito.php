<?php

namespace App\Models\Perubahan;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_perubahan_deposito';
    protected $primaryKey = 'id_deposito';
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
    protected $guarded = ['id_deposito'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
