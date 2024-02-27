@extends('partial.main')
@section('konten')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="m-0" style="letter-spacing: 2px;">
                                    <b>Data {{ $title }}</b>
                                </h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                    <li class="breadcrumb-item active">Data {{ $title }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Konten start --}}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <a class="btn btn-primary btn-icon-split btn-sm" href="addendum/create">
                                    <span class="icon text-white-50">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </span>
                                    <span class="text">Tambah Data {{ $title }}</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="/create"> link ....</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Konten End --}}


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <a class="btn btn-primary btn-icon-split btn-sm" href="addendum/create">
                                    <span class="icon text-white-50">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </span>
                                    <span class="text">Tambah Data {{ $title }}</span>
                                </a>
                            </div>
                            <div class="card-body">
                                {{-- <iframe width="420" height="345"
                                    src="https://www.youtube.com/embed/tgbNymZ7vqY?autoplay=1&mute=1&playlist=FZiJMpuq2ug&loop=1">
                                </iframe>
                                <iframe width="560" height="315"
                                    src="https://www.youtube.com/embed/Sye3qL2lpC4?autoplay=1&mute=1&playlist=Sye3qL2lpC4&loop=1"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe> --}}

                                {{-- <iframe class="vidio-embed"
                                    src="https://www.vidio.com/embed/8031936?autoplay=true&player_only=true&mute=false"
                                    width="560" height="317" scrolling="no" frameborder="0" allowfullscreen
                                    allow="encrypted-media *;"></iframe>
                                <script src="//static-web.prod.vidiocdn.com/assets/javascripts/vidio-embed.js"></script> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        {{-- Konten End --}}

    </div>
@endsection
