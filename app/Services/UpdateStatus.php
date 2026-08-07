<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class UpdateStatus
 * @package App\Services
 */
class UpdateStatus
{
    // load services
    protected $emailServices;
    public function __construct(EmailServices $emailServices)
    {
        $this->emailServices = $emailServices;
    }


    public function updateStatus(Request $request, $data, $payload, $status)
    {
        $nama = auth()->user()->nama;
        $jabatan = auth()->user()->sub_jabatan;
        $nama_field = '';


        // tentuin user dan field apa yang akan diupdate
        switch ($jabatan) {
            case 'Pimpinan Cabang':
                $nama_field = 'pincab';
                break;
            case 'Pembukuan':
                $nama_field = 'pembukuan';
                break;
            case 'SDM':
                $nama_field = 'sdm';
                break;
            case 'Direktur Operasional':
                $nama_field = 'dirops';
                break;
            case 'Direktur Komersial':
                $nama_field = 'dirops';
                break;
            case 'Staff Komersial Pusat':
            case 'Staff Komersial':
            case 'Analis Pusat':
                $nama_field = 'komersial';
                break;
            case 'TSI':
                $nama_field = 'tsi';
                break;

            default:
                break;
        }

        // update data
        $data->update([
            'nama_' . $nama_field => $nama,
            'status_' . $nama_field => $status,
            'tgl_status_' . $nama_field => now(),
            'catatan_' . $nama_field => $request->catatan,
            'status_akhir' => $payload['status_akhir']
        ]);

        // cek payload jabatan next nya apa
        if ($payload['jabatan_next'] != null) {
            $jabatan_next = $payload['jabatan_next'];

            // cek harus pakai get() apa first()
            if ($jabatan_next == 'Pembukuan' || $jabatan_next == 'SDM' || $jabatan_next == 'TSI') {
                # code...
                $userNext = User::where('jabatan', $payload['jabatan_next'])
                    ->where('email', 'not like', '%dummy%')
                    ->where('email', 'not like', '%alt%')->where('status', 'Aktif')
                    ->where('email', 'like', '%@gmail.com')->get();
            } else {
                $userNext = User::where('jabatan', $payload['jabatan_next'])
                    ->where('email', 'not like', '%dummy%')
                    ->where('email', 'not like', '%alt%')
                    ->where('status', 'Aktif')->where('email', 'like', '%@gmail.com')->first();
            }

            // cek data dari get() atau first()
            if ($userNext instanceof Collection) {
                $this->emailServices->SendEmailDobel(
                    $data,
                    $userNext,
                    $payload['url'],
                    $payload['title'],
                    $payload['message'],
                    $payload['subjek'],
                );
            } else {
                $this->emailServices->SendEmail(
                    $data,
                    $userNext,
                    $payload['url'],
                    $payload['title'],
                    $payload['message'],
                    $payload['subjek'],
                );
            }
        }
    }


    public function infoUserLain($data, $payload)
    {
        $userPenerima = User::where('jabatan', $payload['jabatan_sama'])
            ->where('email', 'not like', '%dummy%')->where('email', 'not like', '%alt%')
            ->where('status', 'Aktif')
            ->where('email', 'like', '%@gmail.com')
            ->where('nama', '!=', auth()->user()->nama)->get();

        $title = 'Pengajuan Sudah Dikerjakan!';
        $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';

        $this->emailServices->SendEmailToUserLain(
            $data,
            $userPenerima,
            $payload['url'],
            $title,
            $message,
            $payload['subjek']
        );
    }


    public function infoStatusEnd($data, $payload)
    {
        $status_akhir = $payload['status_akhir'];
        $userPenerima = User::where('id_cabang', $data->id_cabang)
            ->where('jabatan', 'Kasi Operasional')
            ->where('email', 'not like', '%dummy%')
            ->where('email', 'not like', '%alt%')->where('status', 'Aktif')
            ->where('email', 'like', '%@gmail.com')->first();

        // pemberitahuan database
        $title = 'Pengajuan Telah Selesai!';
        $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: ' . $status_akhir . '!';
        $this->emailServices->SendEmailToKaops(
            $data,
            $status_akhir,
            $userPenerima,
            $payload['url'],
            $title,
            $message,
            $payload['subjek']
        );
    }


    public function infoStatusEndDouble($data, $payload)
    {
        $status_akhir = $payload['status_akhir'];
        $userPenerima = User::where('id_cabang', $data->id_cabang)
            ->where('jabatan', $payload['jabatan_next'])
            ->where('email', 'not like', '%dummy%')
            ->where('email', 'not like', '%alt%')->where('status', 'Aktif')
            ->where('email', 'like', '%@gmail.com')->first();

        // pemberitahuan database
        $title = 'Pengajuan Telah Selesai!';
        $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: ' . $status_akhir . '!';
        $this->emailServices->SendEmailDobelEnded(
            $data,
            $userPenerima,
            $payload['url'],
            $title,
            $message,
            $payload['subjek']
        );
    }
}
