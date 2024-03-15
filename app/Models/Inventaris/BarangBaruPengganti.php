<?php

namespace App\Models\Inventaris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangBaruPengganti extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_barang_pembanding_pengganti';
    protected $dates = [
        'created_at', 'updated_at'
    ];
    protected $primaryKey = 'id_barang_pembanding_pengganti';

    protected $guarded = ['id_barang_pembanding_pengganti'];

    public function Inventaris()
    {
        return $this->belongsTo(Inventaris::class, 'id_inventaris_pengganti', 'id_inventaris_pengganti');
    }
}
