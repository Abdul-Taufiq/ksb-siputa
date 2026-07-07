<?php

namespace App\Services;

use App\Notifications\NotifikasiPengajuan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class EmailServices
{
    protected PushNotificationService $pushNotificationService;

    public function __construct(PushNotificationService $pushNotificationService)
    {
        $this->pushNotificationService = $pushNotificationService;
    }

    // Email single
    public function SendEmail($data, $userPenerima, $url, $title, $message, $subjek)
    {
        if ($userPenerima != null) {
            try {
                Mail::send('email.notif.email-pengajuan',  [
                    'kode_form' => $data->kode_form,
                    'kc' => $data->cabang->cabang,
                    'keperluan' => $data->keperluan
                ], function ($message) use ($userPenerima, $subjek) {
                    $message->from(config('mail.from.address'), 'KSB | Si-Puta');
                    $message->to($userPenerima->email);
                    $message->subject($subjek);
                });
            } catch (\Throwable $e) {
                Log::error('Gagal mengirim Email Notification', [
                    'user_id' => $userPenerima->id,
                    'email' => $userPenerima->email,
                    'kode_form' => $data->kode_form,
                    'message' => $e->getMessage(),
                ]);
            }

            // pemberitahuan database
            Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));

            $this->pushNotificationService->send(
                $userPenerima,
                [
                    'title' => 'KSB | Si-Puta',
                    'body' => "{$subjek}\nKode Form: {$data->kode_form}\n{$message}",
                    'url' => $url . '?kode=' . ($data->kode_form),
                    'tag'   => 'NEED ACTION FROM YOU',
                    'icon'  => '/icon.png',
                ]
            );
        }
    }



    // Email Doubel
    public function SendEmailDobel($data, $userPenerima, $url, $title, $message, $subjek)
    {
        $emails = $userPenerima->pluck('email')->toArray();

        try {
            Mail::send('email.notif.email-pengajuan',  [
                'kc' => $data->cabang->cabang,
                'kode_form' => $data->kode_form,
                'keperluan' => $data->keperluan
            ], function ($message) use ($emails, $subjek) {
                $message->from(config('mail.from.address'), 'KSB | Si-Puta');
                $message->to($emails[0]); // penerima utama
                $message->cc(array_slice($emails, 1)); // sisanya jadi CC
                $message->subject($subjek);
            });
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim Email Notification', [
                'user_id' => $userPenerima->id,
                'email' => $userPenerima->email,
                'kode_form' => $data->kode_form,
                'message' => $e->getMessage(),
            ]);
        }

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));

        $this->pushNotificationService->send(
            $userPenerima,
            [
                'title' => 'KSB | Si-Puta',
                'body' => sprintf(
                    "%s\nKode Form: %s",
                    $message,
                    $data->kode_form
                ),
                'url' => $url . '?kode=' . ($data->kode_form),
                'tag'   => 'NEED ACTION FROM YOU',
                'icon'  => '/icon.png',
            ]
        );
    }


    // Email single to user lainnya
    public function SendEmailToUserLain($data, $userPenerima, $url, $title, $message, $subjek)
    {
        if ($userPenerima !== null) {
            try {
                Mail::send('email.notif.email-dikerjakan',  [
                    'kc' => $data->cabang->cabang,
                    'kode_form' => $data->kode_form,
                    'keperluan' => $data->keperluan
                ], function ($message) use ($userPenerima, $subjek) {
                    $message->from(config('mail.from.address'), 'KSB | Si-Puta');
                    $message->to($userPenerima->email);
                    $message->subject($subjek);
                });
            } catch (\Throwable $e) {
                Log::error('Gagal mengirim Email Notification', [
                    'user_id' => $userPenerima->id,
                    'email' => $userPenerima->email,
                    'kode_form' => $data->kode_form,
                    'message' => $e->getMessage(),
                ]);
            }

            // pemberitahuan database
            Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));

            $this->pushNotificationService->send(
                $userPenerima,
                [
                    'title' => 'KSB | Si-Puta',
                    'body' => "{$subjek}\nKode Form: {$data->kode_form}\n{$message}",
                    'url' => $url . '?kode=' . ($data->kode_form),
                    'tag'   => 'NEED ACTION FROM YOU',
                    'icon'  => '/icon.png',
                ]
            );
        }
    }



    public function SendEmailEnded($data, $userPenerima, $url, $title, $message, $subjek)
    {
        if ($userPenerima !== null) {
            try {
                Mail::send('email.notif.email-status-akhir',  [
                    'kc' => $data->cabang->cabang,
                    'kode_form' => $data->kode_form,
                    'keperluan' => $data->keperluan,
                    'status_akhir' => $data->status_akhir,
                ], function ($message) use ($userPenerima, $subjek) {
                    $message->from(config('mail.from.address'), 'KSB | Si-Puta');
                    $message->to($userPenerima->email);
                    $message->subject($subjek);
                });
            } catch (\Throwable $e) {
                Log::error('Gagal mengirim Email Notification', [
                    'user_id' => $userPenerima->id,
                    'email' => $userPenerima->email,
                    'kode_form' => $data->kode_form,
                    'message' => $e->getMessage(),
                ]);
            }

            // pemberitahuan database
            Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));

            $this->pushNotificationService->send(
                $userPenerima,
                [
                    'title' => 'KSB | Si-Puta',
                    'body' => "{$subjek}\nKode Form: {$data->kode_form}\n{$message}",
                    'url' => $url . '?kode=' . ($data->kode_form),
                    'tag'   => 'NEED ACTION FROM YOU',
                    'icon'  => '/icon.png',
                ]
            );
        }
    }


    public function SendEmailDobelEnded($data, $userPenerima, $url, $title, $message, $subjek)
    {
        $emails = $userPenerima->pluck('email')->toArray();

        if ($emails !== null) {
            try {
                Mail::send('email.notif.email-status-akhir',  [
                    'kc' => $data->cabang->cabang,
                    'kode_form' => $data->kode_form,
                    'keperluan' => $data->keperluan,
                    'status_akhir' => $data->status_akhir
                ], function ($message) use ($emails, $subjek) {
                    $message->from(config('mail.from.address'), 'KSB | Si-Puta');
                    $message->to($emails[0]); // penerima utama
                    $message->cc(array_slice($emails, 1)); // sisanya jadi CC
                    $message->subject($subjek);
                });
            } catch (\Throwable $e) {
                Log::error('Gagal mengirim Email Notification', [
                    'user_id' => $userPenerima->id,
                    'email' => $userPenerima->email,
                    'kode_form' => $data->kode_form,
                    'message' => $e->getMessage(),
                ]);
            }

            // pemberitahuan database
            Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));

            $this->pushNotificationService->send(
                $userPenerima,
                [
                    'title' => 'KSB | Si-Puta',
                    'body' => "{$subjek}\nKode Form: {$data->kode_form}\n{$message}",
                    'url' => $url . '?kode=' . ($data->kode_form),
                    'tag'   => 'NEED ACTION FROM YOU',
                    'icon'  => '/icon.png',
                ]
            );
        }
    }





    // Email single to kaops
    public function SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message, $subjek)
    {
        if ($userPenerima !== null) {
            try {
                Mail::send('email.notif.email-status-akhir',  [
                    'kode_form' => $data->kode_form,
                    'kc' => $data->cabang->cabang,
                    'keperluan' => $data->keperluan,
                    'status_akhir' => $status_akhir,
                ], function ($message) use ($userPenerima, $subjek) {
                    $message->from(config('mail.from.address'), 'KSB | Si-Puta');
                    $message->to($userPenerima->email);
                    $message->subject($subjek);
                });
            } catch (\Throwable $e) {
                Log::error('Gagal mengirim Email Notification', [
                    'user_id' => $userPenerima->id,
                    'email' => $userPenerima->email,
                    'kode_form' => $data->kode_form,
                    'message' => $e->getMessage(),
                ]);
            }


            // pemberitahuan database
            Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));

            $this->pushNotificationService->send(
                $userPenerima,
                [
                    'title' => 'KSB | Si-Puta',
                    'body' => "{$subjek}\nKode Form: {$data->kode_form}\n{$message}",
                    'url' => $url . '?kode=' . ($data->kode_form),
                    'tag'   => 'NEED ACTION FROM YOU',
                    'icon'  => '/icon.png',
                ]
            );
        }
    }
}
