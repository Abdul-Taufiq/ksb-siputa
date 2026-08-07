<?php

namespace App\Models\MasterInsentif;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InsAO extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_insen_ao';
    protected $dates = [
        'created_at',
        'updated_at',
        'tgl_status_pincab',
        'tgl_status_sdm',
        'tgl_status_dirops',
        'tgl_status_komersial',
        'tgl_status_dirops',
        'tgl_creator'
    ];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function pembagian(): HasMany
    {
        return $this->hasMany(InsAODeb::class, 'id_ins_ao', 'id');
    }
}
