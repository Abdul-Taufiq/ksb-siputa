<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    public function UserCreate(User $user)
    {
        if (
            $user->jabatan === 'Kasi Operasional' || $user->jabatan === 'Kasi Komersial' ||
            $user->jabatan === 'SDM' || $user->jabatan === 'Analis Area' || $user->jabatan === 'Staf Area' || $user->jabatan === 'Kepala Kantor Kas' ||
            $user->jabatan === 'Sekretariat'
        ) {
            return TRUE;
        } else {
            return Response::denyWithStatus(403, 'Anda tidak diizinkan mengakses halaman ini!');
        }
    }


    public function TarikData(User $user)
    {
        if (
            $user->jabatan === 'SDM' || $user->jabatan === 'Pembukuan'
        ) {
            return TRUE;
        } else {
            return Response::denyWithStatus(403, 'Anda tidak diizinkan mengakses halaman ini!');
        }
    }
}
