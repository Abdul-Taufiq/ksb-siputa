<?php

namespace App\Models\User;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmailR extends Model
{
    use HasFactory, Notifiable;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_email_r';
    protected $dates = [
        'created_at', 'updated_at', 'tgl_status_pincab',
        'tgl_status_sdm', 'tgl_status_dirops', 'tgl_status_akhir', 'tgl_status_tsi'
    ];
    protected $primaryKey = 'id_reset';
    protected $guarded = ['id_reset'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
