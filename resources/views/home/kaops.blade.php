{{-- user --}}
<section class="content isi_konten">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h4 class="card-title">DATA USER</h4>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- EMail --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-info">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Pengajuan Email &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EmailP->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EmailP->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EmailP->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EmailP->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/user-email-pengajuan">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Reset Email --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-info">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Reset Password Email &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EmailR->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EmailR->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EmailR->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EmailR->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/user-email-reset">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Siadit --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-secondary">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Pengajuan User SIAdit &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $USiadit->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $USiadit->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $USiadit->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $USiadit->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/user-siadit">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- SLIK  --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-secondary">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; User SLIK &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PSlik->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PSlik->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PSlik->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PSlik->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/slik-pengajuan">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- MBS --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-info">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Pengajuan User MSO &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $UserP->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $UserP->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $UserP->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $UserP->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/mso-pengajuan">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Reset MBS --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-info">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Reset Password MSO &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $UserR->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $UserR->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $UserR->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $UserR->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/mso-reset">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Ecoll --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-secondary">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; User Baru E-Collector &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EcollP->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EcollP->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EcollP->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EcollP->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/user-ecoll">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Ecoll Reset --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-secondary">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Reset User E-Collector &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EcollR->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EcollR->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EcollR->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $EcollR->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/reset-ecoll">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Pefindo --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-info">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; User Baru Pefindo &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Pefindo->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Pefindo->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Pefindo->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Pefindo->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/pefindo-pengajuan">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Pefindo Reset --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-info">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Reset User Pefindo &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PefindoRe->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PefindoRe->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PefindoRe->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PefindoRe->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/pefindo-reset">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card card-outline card-danger mb-0"></div>
        </div>
    </div>
</section>
{{-- end USer --}}


{{-- Transaksi Pembatalan --}}
<section class="content isi_konten">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h4 class="card-title">DATA PEMBATALAN TRANSAKSI</h4>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Akuntansi --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-info">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Transaksi Akuntansi &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Akuntansi->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Akuntansi->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Akuntansi->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Akuntansi->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/pembatalan-akuntansi">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Antar Bank --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-info">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Transaksi Antar Bank &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Antarbank->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Antarbank->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Antarbank->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Antarbank->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/pembatalan-antarbank">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Antar Kantor --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-secondary">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Transaksi Antar Kantor &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Antarkantor->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Antarkantor->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Antarkantor->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Antarkantor->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/pembatalan-antarkantor">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Deposito --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-secondary">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Transaksi Deposito &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PDeposito->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PDeposito->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PDeposito->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PDeposito->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/pembatalan-deposito">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- E-Collector --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-info">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Transaksi E-Collector &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PEcoll->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PEcoll->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PEcoll->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $PEcoll->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/pembatalan-ecoll">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Inventaris --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-info">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Transaksi Inventaris &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Inventaris->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Inventaris->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Inventaris->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Inventaris->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/pembatalan-inventaris">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Kredit --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-secondary">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Transaksi Kredit &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Kredit->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Kredit->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Kredit->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Kredit->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/pembatalan-kredit">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Tabungan --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-secondary">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Transaksi Tabungan &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Tabungan->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Tabungan->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Tabungan->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Tabungan->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/pembatalan-tabungan">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card card-outline card-danger mb-0"></div>
        </div>
    </div>
</section>
{{-- End Transaksi Pembatalan --}}


{{-- Transaksi Perubahan --}}
<section class="content isi_konten">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h4 class="card-title">DATA PERUBAHAN TRANSAKSI</h4>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- CIF --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-info">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Transaksi CIF &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Cif->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Cif->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Cif->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $Cif->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/perubahan-cif">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Master Kredit --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-info">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Transaksi Master Kredit &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $perKredit->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $perKredit->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $perKredit->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $perKredit->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/perubahan-kredit">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Master Deposito --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-secondary">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Transaksi Master Deposito &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $perDeposito->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $perDeposito->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $perDeposito->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $perDeposito->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/perubahan-deposito">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-outline card-danger mb-0"></div>
        </div>
    </div>
</section>
{{-- End Transaksi Perubahan --}}


{{-- Pengajuan Inventaris  --}}
<section class="content isi_konten">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h4 class="card-title">DATA PENGAJUAN INVENTARIS</h4>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- CIF --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-info">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Inventaris Baru &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $inv_baru->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $inv_baru->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $inv_baru->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $inv_baru->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/inventaris-pengajuan">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                    {{-- Master Kredit --}}
                    <div class="col-md-6">
                        <div class="card card-widget card-outline card-secondary">
                            <div class="user-header bg-info">
                                <h5 style="text-align: center; margin-top: 6px;">
                                    &rAarr; &nbsp; Inventaris Pengganti &nbsp; &lAarr;
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 border-right bg-info">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $inv_pengganti->where('id_cabang', $id_cabang)->count() }}
                                            </h5>
                                            <span class="description-text">ALL</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-success">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $inv_pengganti->where('id_cabang', $id_cabang)->where('status_akhir', 'Selesai')->count() }}
                                            </h5>
                                            <span class="description-text">APPROVED</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 border-right bg-warning">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $inv_pengganti->where('id_cabang', $id_cabang)->where('status_akhir', 'Proses')->count() }}
                                            </h5>
                                            <span class="description-text">PROCCESS</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 bg-danger">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                {{ $inv_pengganti->where('id_cabang', $id_cabang)->where('status_akhir', 'Ditolak')->count() }}
                                            </h5>
                                            <span class="description-text">REJECTED</span>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin: 10px 0px -10px 0px">
                                    <a href="/inventaris-pengganti">
                                        More info ... <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary mb-0"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card card-outline card-danger mb-0"></div>
        </div>
    </div>
</section>
{{-- End Pengajuan Inventaris  --}}
