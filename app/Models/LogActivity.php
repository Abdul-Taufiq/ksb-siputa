<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'log_activity';
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'id_log';

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
