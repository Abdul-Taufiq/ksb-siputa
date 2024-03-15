<?php

namespace App\Models\TSI;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeliharaanHistory extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_pemeliharaan_history';
    protected $dates = [
        'created_at', 'updated_at', 'tgl_dilaksanakan'
    ];
    protected $primaryKey = 'id_pemeliharaan_history';

    protected $guarded = ['id_pemeliharaan_history'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function Pemeliharaan()
    {
        return $this->hasMany(Pemeliharaan::class, 'id_pemeliharaan', 'id_pemeliharaan');
    }
}
