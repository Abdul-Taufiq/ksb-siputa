<?php

namespace App\Services;

use App\Notifications\NotifikasiPengajuan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class EmailServices
{
    // Email single
    public function SendEmail($data, $userPenerima, $url, $title, $message, $subjek)
    {
        if ($userPenerima != null) {
            Mail::send('email.notif.email-pengajuan',  [
                'kode_form' => $data->kode_form,
                'kc' => $data->cabang->cabang,
                'keperluan' => $data->keperluan
            ], function ($message) use ($userPenerima, $subjek) {
                $message->from(config('mail.from.address'), 'KSB | Si-PUTa');
                $message->to($userPenerima->email);
                $message->subject($subjek);
            });

            // pemberitahuan database
            Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
        }
    }



    // Email Doubel
    public function SendEmailDobel($data, $userPenerima, $url, $title, $message, $subjek)
    {
        $emails = $userPenerima->pluck('email')->toArray();

        Mail::send('email.notif.email-pengajuan',  [
            'kc' => $data->cabang->cabang,
            'kode_form' => $data->kode_form,
            'keperluan' => $data->keperluan
        ], function ($message) use ($emails, $subjek) {
            $message->from(config('mail.from.address'), 'KSB | Si-PUTa');
            $message->to($emails[0]); // penerima utama
            $message->cc(array_slice($emails, 1)); // sisanya jadi CC
            $message->subject($subjek);
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }


    // Email single to user lainnya
    public function SendEmailToUserLain($data, $userPenerima, $url, $title, $message, $subjek)
    {
        if ($userPenerima !== null) {
            Mail::send('email.notif.email-dikerjakan',  [
                'kc' => $data->cabang->cabang,
                'kode_form' => $data->kode_form,
                'keperluan' => $data->keperluan
            ], function ($message) use ($userPenerima, $subjek) {
                $message->from(config('mail.from.address'), 'KSB | Si-PUTa');
                $message->to($userPenerima->email);
                $message->subject($subjek);
            });

            // pemberitahuan database
            Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
        }
    }



    public function SendEmailEnded($data, $userPenerima, $url, $title, $message, $subjek)
    {
        if ($userPenerima !== null) {
            Mail::send('email.notif.email-status-akhir',  [
                'kc' => $data->cabang->cabang,
                'kode_form' => $data->kode_form,
                'keperluan' => $data->keperluan,
                'status_akhir' => $data->status_akhir,
            ], function ($message) use ($userPenerima, $subjek) {
                $message->from(config('mail.from.address'), 'KSB | Si-PUTa');
                $message->to($userPenerima->email);
                $message->subject($subjek);
            });

            // pemberitahuan database
            Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
        }
    }

    public function SendEmailDobelEnded($data, $userPenerima, $url, $title, $message, $subjek)
    {
        $emails = $userPenerima->pluck('email')->toArray();

        if ($emails !== null) {
            Mail::send('email.notif.email-status-akhir',  [
                'kc' => $data->cabang->cabang,
                'kode_form' => $data->kode_form,
                'keperluan' => $data->keperluan,
                'status_akhir' => $data->status_akhir
            ], function ($message) use ($emails, $subjek) {
                $message->from(config('mail.from.address'), 'KSB | Si-PUTa');
                $message->to($emails[0]); // penerima utama
                $message->cc(array_slice($emails, 1)); // sisanya jadi CC
                $message->subject($subjek);
            });

            // pemberitahuan database
            Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
        }
    }





    // Email single to kaops
    public function SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message, $subjek)
    {
        if ($userPenerima !== null) {
            Mail::send('email.notif.email-status-akhir',  [
                'kode_form' => $data->kode_form,
                'kc' => $data->cabang->cabang,
                'keperluan' => $data->keperluan,
                'status_akhir' => $status_akhir,
            ], function ($message) use ($userPenerima, $subjek) {
                $message->from(config('mail.from.address'), 'KSB | Si-PUTa');
                $message->to($userPenerima->email);
                $message->subject($subjek);
            });


            // pemberitahuan database
            Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
        }
    }
}
