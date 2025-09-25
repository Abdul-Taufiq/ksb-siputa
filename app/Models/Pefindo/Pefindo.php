<?php

namespace App\Models\Pefindo;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pefindo extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_pefindo';
    protected $dates = [
        'created_at',
        'updated_at',
        'tgl_status_pincab',
        'tgl_status_dirops',
        'tgl_status_akhir',
        'tgl_status_tsi',
        'tgl_status_pembukuan',
        'tgl_status_dirut'
    ];
    protected $primaryKey = 'id_pefindo';

    protected $guarded = ['id_pefindo'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
