<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastVersion extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'tb_version';
    protected $primaryKey = 'id_version';
    protected $dates = ['created_at', 'updated_at', 'tgl_rilis'];
}
