<?php

namespace App\Models\Notifikasi;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Notifikasi extends Model
{
    use HasFactory, Notifiable;
    protected $connection = 'ksb_sdm';
    protected $table = 'notifications';
    protected $dates = [
        'created_at', 'updated_at', 'read_at'
    ];
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function Cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
