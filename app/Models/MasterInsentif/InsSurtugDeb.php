<?php

namespace App\Models\MasterInsentif;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InsSurtugDeb extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_insen_surtug_deb';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function surtug(): BelongsTo
    {
        return $this->belongsTo(InsSurtug::class, 'id_surtug', 'id');
    }
}
