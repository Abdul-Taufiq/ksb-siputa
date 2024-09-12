<?php

namespace App\Models\Inventaris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangBaru extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_barang_pembanding_baru';
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'id_barang_pembanding_baru';

    protected $guarded = ['id_barang_pembanding_baru'];

    public function Inventaris()
    {
        return $this->belongsTo(Inventaris::class, 'id_inventaris_baru', 'id_inventaris_baru');
    }
}
