<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Minishlink\WebPush\Subscription;

class PushSubscibe extends Model
{
    use HasFactory;
    protected $connection = 'ksb_sdm';
    protected $table = 'push_notification';
    protected $dates = ['created_at', 'updated_at', 'unsubscribed_at', 'last_used_at'];
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'device_id',
        'endpoint',
        'public_key',
        'auth_token',
        'device_name',
        'browser',
        'platform',
        'user_agent',
        'is_active',
        'last_used_at',
        'last_push_status',
        'last_push_error',
        'push_fail_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function toSubscription(): Subscription
    {
        return Subscription::create([
            'endpoint'  => $this->endpoint,
            'publicKey' => $this->public_key,
            'authToken' => $this->auth_token,
        ]);
    }

    public const STATUS_SUCCESS = 'SUCCESS';
    public const STATUS_FAILED = 'FAILED';
    public const STATUS_PENDING = 'PENDING';
}
