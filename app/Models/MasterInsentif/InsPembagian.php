<?php

namespace App\Models\MasterInsentif;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InsPembagian extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_insen_pembagian';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function insDebitur(): BelongsTo
    {
        return $this->belongsTo(InsPenyelesaian::class, 'id_ins_penyelesaian', 'id');
    }
}
