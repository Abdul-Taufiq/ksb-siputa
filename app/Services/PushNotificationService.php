<?php

namespace App\Services;

use App\Models\PushSubscibe;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;

class PushNotificationService
{
    protected WebPush $webPush;

    public function __construct()
    {
        $this->webPush = new WebPush([
            'VAPID' => [
                'subject' => 'https://web.bprkusumasumbing.com/',
                'publicKey' => env('VAPID_PUBLIC_KEY'),
                'privateKey' => env('VAPID_PRIVATE_KEY'),
            ],
        ]);
    }


    public function send(User|Collection|array $users, array $payload): bool
    {
        if (empty($payload)) {
            return false;
        }

        if ($users instanceof User) {
            $users = collect([$users]);
        }

        if (is_array($users)) {
            $users = collect($users);
        }

        $success = false;

        /**
         * Semua subscription yang akan dikirim
         */
        $queue = [];

        try {

            /**
             * Ambil seluruh subscription milik seluruh user
             */
            foreach ($users as $user) {

                $subscriptions = PushSubscibe::where('user_id', $user->id)
                    ->where('is_active', true)
                    ->get();

                foreach ($subscriptions as $subscription) {

                    $this->webPush->queueNotification(
                        $subscription->toSubscription(),
                        json_encode(
                            $payload,
                            JSON_UNESCAPED_UNICODE
                        ),
                        [
                            'TTL' => 300,
                            'urgency' => 'high',
                        ]
                    );

                    $queue[$subscription->endpoint] = [
                        'model' => $subscription,
                        'user'  => $user,
                    ];
                }
            }

            /**
             * Tidak ada device yang aktif
             */
            if (empty($queue)) {
                return false;
            }

            /**
             * Kirim semua push
             */
            foreach ($this->webPush->flush() as $report) {
                $endpoint = (string) $report->getRequest()->getUri();
                if (!isset($queue[$endpoint])) {
                    continue;
                }

                $model = $queue[$endpoint]['model'];
                $user  = $queue[$endpoint]['user'];

                if ($report->isSuccess()) {
                    $success = true;
                    $model->update([
                        'last_used_at'      => now(),
                        'last_push_status'  => PushSubscibe::STATUS_SUCCESS,
                        'last_push_error'   => null,
                        'push_fail_count'   => 0,
                    ]);
                } else {
                    $reason = $report->getReason();
                    $update = [
                        'last_push_status' => PushSubscibe::STATUS_FAILED,
                        'last_push_error'  => $reason,
                        'push_fail_count'  => $model->push_fail_count + 1,
                    ];

                    /**
                     * Nonaktifkan jika memang subscription sudah mati
                     */
                    if (
                        str_contains($reason, '404') ||
                        str_contains($reason, '410') ||
                        str_contains(strtolower($reason), 'expired') ||
                        $model->push_fail_count >= 10
                    ) {
                        $update['is_active'] = false;
                        $update['unsubscribed_at'] = now();
                    }

                    $model->update($update);
                    Log::warning('Push Notification Failed', [
                        'user_id'     => $user->id,
                        'device_name' => $model->device_name,
                        'browser'     => $model->browser,
                        'platform'    => $model->platform,
                        'endpoint'    => $endpoint,
                        'reason'      => $reason,
                    ]);
                }
            }
        } catch (\Throwable $e) {
            Log::error('Push Notification Error', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);
            return false;
        }

        return $success;
    }
}
