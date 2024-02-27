<?php

namespace App\Models\Siadit;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class USiadit extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_siadit_user';
    protected $dates = [
        'created_at', 'updated_at', 'aktif', 'non_aktif', 'tgl_status_pincab',
        'tgl_status_sdm', 'tgl_status_dirops', 'tgl_status_akhir', 'tgl_status_tsi'
    ];
    protected $primaryKey = 'id_siadit_user';
    protected $guarded = ['id_siadit_user'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
