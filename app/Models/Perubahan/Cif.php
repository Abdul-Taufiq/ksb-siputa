<?php

namespace App\Models\Perubahan;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cif extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_perubahan_cif';
    protected $primaryKey = 'id_cif';
    protected $dates = [
        'tgl_status_pincab', 'tgl_status_pembukuan', 'tgl_status_tsi', 'tgl_status_dirops',
        'tgl_status_akhir', 'created_at', 'updated_at'
    ];
    protected $guarded = ['id_cif'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
