<?php

namespace App\Models\Pembatalan;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akuntansi extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_pembatalan_akuntansi';
    protected $primaryKey = 'id_akuntansi';
    protected $dates = [
        'tgl_status_pincab', 'tgl_status_pembukuan', 'tgl_status_dirops',
        'tgl_status_akhir', 'created_at', 'updated_at'
    ];
    protected $guarded = ['id_akuntansi'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
