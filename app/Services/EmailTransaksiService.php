<?php

namespace App\Services;

use App\Notifications\NotifikasiPengajuan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class EmailTransaksiService
{

    // Email single
    public function SendEmail($data, $userPenerima, $url, $title, $message)
    {
        if (auth()->user()->jabatan == 'Direktur Operasional') {
            Mail::send('email.notif.notif-to-pembukuan',  [
                'nama' => $data->nama,
                'kc' => $data->cabang->cabang,
                'nik' => $data->nik,
                'kode_form' => $data->kode_form,
                'keperluan' => "Pembatalan Transaksi (Akuntansi)"
            ], function ($message) use ($userPenerima) {
                $message->from(config('mail.from.address'), 'KSB | Si-PUTa');
                $message->to($userPenerima->email);
                $message->subject('Perlu Tindak Lanjut Transaksi (Akuntansi)');
            });
        } else {
            Mail::send('email.notif.notif-pengajuan',  [
                'nama' => $data->nama,
                'kc' => $data->cabang->cabang,
                'nik' => $data->nik,
                'kode_form' => $data->kode_form,
                'keperluan' => "Pembatalan Transaksi (Akuntansi)"
            ], function ($message) use ($userPenerima) {
                $message->from(config('mail.from.address'), 'KSB | Si-PUTa');
                $message->to($userPenerima->email);
                $message->subject('Pengajuan Pembatalan Transaksi (Akuntansi)');
            });
        }


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
            'keperluan' => "Pembatalan Transaksi (Akuntansi)",
            'status_akhir' => $status_akhir,
            'pelanggaran' => ($status_akhir == 'Approved') ? $data->pelanggaran_dirops : null,
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
            'keperluan' => "Pembatalan Transaksi (Akuntansi)"
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
            'keperluan' => "Pembatalan Transaksi (Akuntansi)"
        ], function ($message) use ($emails) {
            $message->from(config('mail.from.address'), 'KSB | Si-PUTa');
            $message->to($emails[0]); // penerima utama
            $message->bcc(array_slice($emails, 1)); // sisanya jadi CC
            $message->subject('Pengajuan Pembatalan Transaksi (Akuntansi)');
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }
}
