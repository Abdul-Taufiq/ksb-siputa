<?php

namespace App\Services;

use App\Models\LogActivity;

class StatusAndLogServices
{
    // ==============
    // button pada status data table index
    public function statusNothing($id, $kode)
    {
        $status = '';
        $status .= '<div class="dropdown">';
        $status .= '<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $status .= 'Nothing';
        $status .= '</button>';
        $status .= '<div class="dropdown-menu" aria-labelledby="statusDropdown">';
        $status .= '<a class="dropdown-item approve" href="#" data-toggle="modal" data-target="#modalApprove" data-id="' . encrypt($id) . '" data-kode_form="' . $kode . '">Approve</a>';
        $status .= '<a class="dropdown-item reject" href="#" data-toggle="modal" data-target="#modalReject" data-id="' . encrypt($id) . '" data-kode_form="' . $kode . '">Reject</a>';
        $status .= '</div>';
        $status .= '</div>';
        return $status;
    }


    public function statusAfter($before_status, $jabatan, $statusDropdown)
    {
        $status = '';
        if ($before_status != null && $before_status != 'Reject') {
            if ($jabatan == 'Approve') {
                $status .= '<a class="btn btn-success btn-sm disabled">Approve</a>';
            } elseif ($jabatan == 'Reject') {
                $status .= '<a class="btn btn-danger btn-sm disabled">Reject</a>';
            } elseif ($jabatan == '--') {
                $status .= '<a class="btn btn-success btn-sm disabled">Ditarik</a>';
            } else {
                return $statusDropdown;
            }
        } else {
            $status .= '<a class="btn btn-info btn-sm disabled">NotNeed</a>';
        }
        return $status;
    }

    // Log activity
    public function LogActivity($data, $LogAksi)
    {
        $log = new LogActivity();
        $log->id_cabang = auth()->user()->id_cabang;
        $log->nama = auth()->user()->nama;
        $log->email = auth()->user()->email;
        $log->level = auth()->user()->jabatan;
        $log->aksi = $LogAksi;
        $log->kode_form = $data->kode_form;
        $log->created_at = now();
        $log->save();
    }
}
