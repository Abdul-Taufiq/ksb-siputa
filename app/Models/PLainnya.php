<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PLainnya extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_pengajuan_lainnya';
    protected $dates = [
        'created_at',
        'updated_at',
        'tgl_status_pincab',
        'tgl_status_pembukuan',
        'tgl_status_dirops',
        'tgl_status_akhir',
        'tgl_status_tsi'
    ];
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
