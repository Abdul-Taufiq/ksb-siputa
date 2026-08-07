<?php

namespace App\Models\MasterInsentif;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InsSurtug extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_insen_surtug';
    protected $dates = [
        'created_at',
        'updated_at',
        'tgl_awal',
        'tgl_akhir',
        'tgl_status_pincab',
        'tgl_creator'
    ];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function surtugDeb(): HasMany
    {
        return $this->hasMany(InsSurtugDeb::class, 'id_surtug', 'id');
    }
}
