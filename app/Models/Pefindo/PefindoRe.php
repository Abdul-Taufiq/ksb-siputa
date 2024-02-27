<?php

namespace App\Models\Pefindo;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PefindoRe extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_pefindo_reset';
    protected $dates = [
        'created_at', 'updated_at', 'tgl_status_pincab', 'tgl_status_dirops', 'tgl_status_akhir', 'tgl_status_tsi'
    ];
    protected $primaryKey = 'id_pefindo_reset';

    protected $guarded = ['id_pefindo_reset'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
