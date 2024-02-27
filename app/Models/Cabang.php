<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'tb_cabang';
    protected $primaryKey = 'id_cabang';

    public function User()
    {
        return $this->hasMany(User::class, 'id_cabang', 'id_cabang');
    }
}
