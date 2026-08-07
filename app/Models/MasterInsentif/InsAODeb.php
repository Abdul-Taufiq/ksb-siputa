<?php

namespace App\Models\MasterInsentif;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InsAODeb extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_insen_ao_deb';
    protected $dates = [
        'tgl_realisasi',
        'created_at',
        'updated_at',
    ];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function insDebitur(): BelongsTo
    {
        return $this->belongsTo(InsAO::class, 'id_ins_ao', 'id');
    }
}
