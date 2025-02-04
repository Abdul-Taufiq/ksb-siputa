<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabangEmail extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'cabang';
    protected $primaryKey = 'id_cabang';
}
