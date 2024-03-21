<?php

use Illuminate\Support\Facades\{Artisan, Route, Auth};
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\{LoginController, UserController, HelperController, RegisterController, HomeController, LogActivityController, LogTrackingController};
use App\Http\Controllers\Ecoll\{EcollPController, EcollRController};
use App\Http\Controllers\Inventaris\InventarisController as InventarisPengajuanController;
use App\Http\Controllers\Inventaris\InventarisPenggantiController;
use App\Http\Controllers\MBS\{UserPController, ResetController};
use App\Http\Controllers\Pefindo\{PefindoController, PefindoreController};
use App\Http\Controllers\Pembatalan\{AkuntansiController, AntarBankController, AntarKantorController, InventarisController, KreditController, PDepositoController, PEcollController, TabunganController};
use App\Http\Controllers\Perubahan\{CifController, DepositoController, KreditController as PerubahanKreditController};
use App\Http\Controllers\Siadit\{PSiaditController, USiaditController};
use App\Http\Controllers\Slik\{PSlikController};
use App\Http\Controllers\TSI\BarangController;
use App\Http\Controllers\TSI\PemeliharaanController;
use App\Http\Controllers\TSI\PemeliharaanHistoryController;
use App\Http\Controllers\User\{EmailRController, EmailPController};

Route::get('/', function () {
    return view('login.login');
});

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

// Login
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'postlogin']);
Route::get('/refereshcapcha', [HelperController::class, 'refereshCaptcha']);

// Lupa Password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// Register
// Route::get('/register', [RegisterController::class, 'index'])->middleware('cektsi');
Auth::routes(['verify' => true]);


Auth::routes();

Route::group(['middleware' => ['permission']], function () {

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/create', [HomeController::class, 'create']);
        Route::get('/profile', [UserController::class, 'profil']);
        Route::post('/profile/upload', [UserController::class, 'upload']);

        // contact
        Route::resource('contact', UserController::class)->parameters(['contact' => 'user']);
        Route::post('/contact-search', [UserController::class, 'search']);


        // Email
        Route::resource('user-email-pengajuan', EmailPController::class)->parameters(['user-email-pengajuan' => 'emailP']);
        Route::patch('/email-approve/{idEncrypt}', [EmailPController::class, 'ResponApprove']);
        Route::patch('/email-reject/{idEncrypt}', [EmailPController::class, 'ResponReject']);


        Route::resource('user-email-reset', EmailRController::class)->parameters(['user-email-reset' => 'emailR']);
        Route::patch('/email-reset-approve/{idEncrypt}', [EmailRController::class, 'ResponApprove']);
        Route::patch('/email-reset-reject/{idEncrypt}', [EmailRController::class, 'ResponReject']);


        // siadit
        Route::resource('user-siadit', USiaditController::class)->parameters(['user-siadit' => 'uSiadit']);
        Route::patch('/siadit-user-approve/{idEncrypt}', [USiaditController::class, 'ResponApprove']);
        Route::patch('/siadit-user-reject/{idEncrypt}', [USiaditController::class, 'ResponReject']);

        Route::resource('siadit-perubahan', PSiaditController::class)->parameters(['siadit-perubahan' => 'pSiadit']);
        Route::patch('/siadit-perubahan-approve/{idEncrypt}', [PSiaditController::class, 'ResponApprove']);
        Route::patch('/siadit-perubahan-reject/{idEncrypt}', [PSiaditController::class, 'ResponReject']);


        // mso user
        Route::resource('mso-pengajuan', UserPController::class)->parameters(['mso-pengajuan' => 'userP']);
        Route::patch('/mso-pengajuan-approve/{idEncrypt}', [UserPController::class, 'ResponApprove']);
        Route::patch('/mso-pengajuan-reject/{idEncrypt}', [UserPController::class, 'ResponReject']);

        Route::resource('mso-reset', ResetController::class)->parameters(['mso-reset' => 'userR']);
        Route::patch('/mso-reset-approve/{idEncrypt}', [ResetController::class, 'ResponApprove']);
        Route::patch('/mso-reset-reject/{idEncrypt}', [ResetController::class, 'ResponReject']);


        // ecoll
        Route::resource('user-ecoll', EcollPController::class)->parameters(['user-ecoll' => 'ecollP']);
        Route::patch('/user-ecoll-approve/{idEncrypt}', [EcollPController::class, 'ResponApprove']);
        Route::patch('/user-ecoll-reject/{idEncrypt}', [EcollPController::class, 'ResponReject']);

        Route::resource('reset-ecoll', EcollRController::class)->parameters(['reset-ecoll' => 'ecollR']);
        Route::patch('/reset-ecoll-approve/{idEncrypt}', [EcollRController::class, 'ResponApprove']);
        Route::patch('/reset-ecoll-reject/{idEncrypt}', [EcollRController::class, 'ResponReject']);


        // slik
        Route::resource('slik-pengajuan', PSlikController::class)->parameters(['slik-pengajuan' => 'pslik']);
        Route::patch('/slik-approve/{idEncrypt}', [PSlikController::class, 'ResponApprove']);
        Route::patch('/slik-reject/{idEncrypt}', [PSlikController::class, 'ResponReject']);


        // pefindo
        Route::resource('pefindo-pengajuan', PefindoController::class)->parameters(['pefindo-pengajuan' => 'pefindo']);
        Route::patch('/pefindo-pengajuan-approve/{idEncrypt}', [PefindoController::class, 'ResponApprove']);
        Route::patch('/pefindo-pengajuan-reject/{idEncrypt}', [PefindoController::class, 'ResponReject']);

        Route::resource('pefindo-reset', PefindoreController::class)->parameters(['pefindo-reset' => 'pefindoRe']);
        Route::patch('/pefindo-reset-approve/{idEncrypt}', [PefindoreController::class, 'ResponApprove']);
        Route::patch('/pefindo-reset-reject/{idEncrypt}', [PefindoreController::class, 'ResponReject']);


        // pembatalan Transaksi
        Route::resource('pembatalan-akuntansi', AkuntansiController::class)->parameters(['pembatalan-akuntansi' => 'akuntansi']);
        Route::any('/pembatalan-akuntansi-approve/{idEncrypt}', [AkuntansiController::class, 'ResponApprove']);
        Route::any('/pembatalan-akuntansi-reject/{idEncrypt}', [AkuntansiController::class, 'ResponReject']);

        Route::resource('pembatalan-antarbank', AntarBankController::class)->parameters(['pembatalan-antarbank' => 'antarbank']);
        Route::any('/pembatalan-aba-approve/{idEncrypt}', [AntarBankController::class, 'ResponApprove']);
        Route::any('/pembatalan-aba-reject/{idEncrypt}', [AntarBankController::class, 'ResponReject']);

        Route::resource('pembatalan-antarkantor', AntarKantorController::class)->parameters(['pembatalan-antarkantor' => 'antarkantor']);
        Route::any('/pembatalan-aka-approve/{idEncrypt}', [AntarKantorController::class, 'ResponApprove']);
        Route::any('/pembatalan-aka-reject/{idEncrypt}', [AntarKantorController::class, 'ResponReject']);

        Route::resource('pembatalan-deposito', PDepositoController::class)->parameters(['pembatalan-deposito' => 'pDeposito']);
        Route::any('/pembatalan-deposito-approve/{idEncrypt}', [PDepositoController::class, 'ResponApprove']);
        Route::any('/pembatalan-deposito-reject/{idEncrypt}', [PDepositoController::class, 'ResponReject']);

        Route::resource('pembatalan-ecoll', PEcollController::class)->parameters(['pembatalan-ecoll' => 'pEcoll']);
        Route::any('/pembatalan-ecoll-approve/{idEncrypt}', [PEcollController::class, 'ResponApprove']);
        Route::any('/pembatalan-ecoll-reject/{idEncrypt}', [PEcollController::class, 'ResponReject']);

        Route::resource('pembatalan-inventaris', InventarisController::class)->parameters(['pembatalan-inventaris' => 'inventaris']);
        Route::any('/pembatalan-inventaris-approve/{idEncrypt}', [InventarisController::class, 'ResponApprove']);
        Route::any('/pembatalan-inventaris-reject/{idEncrypt}', [InventarisController::class, 'ResponReject']);

        Route::resource('pembatalan-kredit', KreditController::class)->parameters(['pembatalan-kredit' => 'kredit']);
        Route::any('/pembatalan-kredit-approve/{idEncrypt}', [KreditController::class, 'ResponApprove']);
        Route::any('/pembatalan-kredit-reject/{idEncrypt}', [KreditController::class, 'ResponReject']);

        Route::resource('pembatalan-tabungan', TabunganController::class)->parameters(['pembatalan-tabungan' => 'tabungan']);
        Route::any('/pembatalan-tabungan-approve/{idEncrypt}', [TabunganController::class, 'ResponApprove']);
        Route::any('/pembatalan-tabungan-reject/{idEncrypt}', [TabunganController::class, 'ResponReject']);


        // perubahan Transaksi
        Route::resource('perubahan-cif', CifController::class)->parameters(['perubahan-cif' => 'cif']);
        Route::patch('/perubahan-cif-approve/{idEncrypt}', [CifController::class, 'ResponApprove']);
        Route::patch('/perubahan-cif-reject/{idEncrypt}', [CifController::class, 'ResponReject']);

        Route::resource('perubahan-deposito', DepositoController::class)->parameters(['perubahan-deposito' => 'deposito']);
        Route::patch('/perubahan-deposito-approve/{idEncrypt}', [DepositoController::class, 'ResponApprove']);
        Route::patch('/perubahan-deposito-reject/{idEncrypt}', [DepositoController::class, 'ResponReject']);

        Route::resource('perubahan-kredit', PerubahanKreditController::class)->parameters(['perubahan-kredit' => 'kredit']);
        Route::patch('/perubahan-kredit-approve/{idEncrypt}', [PerubahanKreditController::class, 'ResponApprove']);
        Route::patch('/perubahan-kredit-reject/{idEncrypt}', [PerubahanKreditController::class, 'ResponReject']);

        // Pengajuan Inventaris
        Route::resource('inventaris-pengajuan', InventarisPengajuanController::class)->parameters(['inventaris-pengajuan' => 'inventaris']);
        Route::patch('/inventaris-pengajuan-approve/{idEncrypt}', [InventarisPengajuanController::class, 'ResponApprove']);
        Route::patch('/inventaris-pengajuan-reject/{idEncrypt}', [InventarisPengajuanController::class, 'ResponReject']);
        Route::get('/inventaris-baru-cetak/{idEncrypt}', [InventarisPengajuanController::class, 'Print']);

        // Pengajuan Inventaris Pengganti
        Route::resource('inventaris-pengganti', InventarisPenggantiController::class)->parameters(['inventaris-pengganti' => 'inventarisPengganti']);
        Route::patch('/inventaris-pengganti-approve/{idEncrypt}', [InventarisPenggantiController::class, 'ResponApprove']);
        Route::patch('/inventaris-pengganti-reject/{idEncrypt}', [InventarisPenggantiController::class, 'ResponReject']);
        Route::get('/inventaris-cetak/{idEncrypt}', [InventarisPenggantiController::class, 'Print']);

        // Pemeliharaan Perangkat
        Route::resource('pemeliharaan-perangkat', PemeliharaanController::class)->parameters(['pemeliharaan-perangkat' => 'pemeliharaan']);
        Route::patch('/pemeliharaan-perangkat-approve/{idEncrypt}', [PemeliharaanController::class, 'ResponApprove']);
        Route::patch('/pemeliharaan-perangkat-reject/{idEncrypt}', [PemeliharaanController::class, 'ResponReject']);

        // TSI PErmohonan Bantuan
        Route::resource('pemeliharaan-history', PemeliharaanHistoryController::class)->parameters(['pemeliharaan-history' => 'pemeliharaanHistory']);
        Route::resource('tsi-barang-elektro', BarangController::class)->parameters(['tsi-barang-elektro' => 'barang']);


        // log activity
        Route::resource('log-activity', LogActivityController::class)->parameters(['log-activity' => 'logActivity']);
        Route::get('/pemberitahuan', [LogActivityController::class, 'Pemberitahuan']);
        Route::get('/mark-as-read-pemberitahuan', [LogActivityController::class, 'MarkAsRead']);
    });
});
