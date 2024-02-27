<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionTokens extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'permission_access_tokens';
    protected $primaryKey = 'id';
}
