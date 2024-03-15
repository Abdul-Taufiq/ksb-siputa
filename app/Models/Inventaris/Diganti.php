<?php

namespace App\Models\Inventaris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diganti extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_inventaris_diganti';
    protected $dates = [
        'created_at', 'updated_at', 'tgl_pembelian'
    ];
    protected $primaryKey = 'id_inventaris_diganti';

    protected $guarded = ['id_inventaris_diganti'];

    public function InventarisPengganti()
    {
        return $this->belongsTo(InventarisPengganti::class, 'id_inventaris_pengganti', 'id_inventaris_pengganti');
    }
}
