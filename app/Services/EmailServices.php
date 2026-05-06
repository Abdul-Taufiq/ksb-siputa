<?php

namespace App\Services;

use App\Notifications\NotifikasiPengajuan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class EmailServices
{
    // Email single
    public function SendEmail($data, $userPenerima, $url, $title, $message)
    {
        Mail::send('email.notif.notif-pengajuan',  [
            'nama' => $data->nama,
            'kc' => $data->cabang->cabang,
            'nik' => $data->nik,
            'kode_form' => $data->kode_form,
            'keperluan' => $data->keperluan
        ], function ($message) use ($userPenerima) {
            $message->from(config('mail.from.address'), 'KSB | Si-PUTa');
            $message->to($userPenerima->email);
            $message->subject('Pengajuan User Baru (SLIK)');
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }

    // Email single to kaops
    public function SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message)
    {
        Mail::send('email.notif.notif-status-akhir',  [
            'nama' => $data->nama,
            'kc' => $data->cabang->cabang,
            'nik' => $data->nik,
            'kode_form' => $data->kode_form,
            'keperluan' => $data->keperluan,
            'status_akhir' => $status_akhir,
        ], function ($message) use ($userPenerima) {
            $message->from(config('mail.from.address'), 'KSB | Si-PUTa');
            $message->to($userPenerima->email);
            $message->subject('Status Pengajuan');
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }

    // Email single to user lainnya
    public function SendEmailToUserLain($data, $userPenerima, $url, $title, $message)
    {
        Mail::send('email.notif.notif-dikerjakan',  [
            'nama' => $data->nama,
            'kc' => $data->cabang->cabang,
            'nik' => $data->nik,
            'kode_form' => $data->kode_form,
            'keperluan' => $data->keperluan
        ], function ($message) use ($userPenerima) {
            $message->from(config('mail.from.address'), 'KSB | Si-PUTa');
            $message->to($userPenerima->email);
            $message->subject('Status Pengajuan');
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }

    // Email Doubel
    public function SendEmailDobel($data, $userPenerima, $url, $title, $message)
    {
        $emails = $userPenerima->pluck('email')->toArray();

        Mail::send('email.notif.notif-pengajuan',  [
            'nama' => $data->nama,
            'kc' => $data->cabang->cabang,
            'nik' => $data->nik,
            'kode_form' => $data->kode_form,
            'keperluan' => $data->keperluan
        ], function ($message) use ($emails) {
            $message->from(config('mail.from.address'), 'KSB | Si-PUTa');
            $message->to($emails[0]); // penerima utama
            $message->cc(array_slice($emails, 1)); // sisanya jadi CC
            $message->subject('Pengajuan User Baru (SLIK)');
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }




    public function SendEmailEnded($data, $userPenerima, $url, $title, $message)
    {
        Mail::send('email.notif.notif-pengajuan-ended',  [
            'nama' => $data->nama,
            'kc' => $data->cabang->cabang,
            'nik' => $data->nik,
            'kode_form' => $data->kode_form,
            'keperluan' => $data->keperluan,
            'catatan' => $data->catatan_tsi
        ], function ($message) use ($userPenerima) {
            $message->from(config('mail.from.address'), 'KSB | Si-PUTa');
            $message->to($userPenerima->email);
            $message->subject('Pengajuan Reset Password (MSO)');
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }

    public function SendEmailDobelEnded($data, $userPenerima, $url, $title, $message)
    {
        $emails = $userPenerima->pluck('email')->toArray();

        Mail::send('email.notif.notif-pengajuan-ended',  [
            'nama' => $data->nama,
            'kc' => $data->cabang->cabang,
            'nik' => $data->nik,
            'kode_form' => $data->kode_form,
            'keperluan' => $data->keperluan
        ], function ($message) use ($emails) {
            $message->from(config('mail.from.address'), 'KSB | Si-PUTa');
            $message->to($emails[0]); // penerima utama
            $message->cc(array_slice($emails, 1)); // sisanya jadi CC
            $message->subject('Pengajuan Reset Password (MSO)');
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }
}
