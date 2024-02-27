<?php

namespace App\Models\User;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailPe extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_email_p';
    protected $dates = [
        'created_at', 'updated_at', 'aktif', 'non_aktif', 'tgl_status_pincab',
        'tgl_status_sdm', 'tgl_status_dirops', 'tgl_status_akhir', 'tgl_status_tsi'
    ];
    protected $primaryKey = 'id_pengajuan';
    protected $guarded = ['id_pengajuan'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    // public function LogTracking()
    // {
    //     return $this->hasMany(LogTracking::class, 'id_tracking', 'id_tracking');
    // }
}
