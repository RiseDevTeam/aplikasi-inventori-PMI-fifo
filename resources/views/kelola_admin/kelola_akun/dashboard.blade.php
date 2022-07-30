@extends('tampilan.admin')

@section('title', 'Dashboard')

@section('admin')

    <div class="content-wrapper">
        <!-- Main content -->

        <div class="page-title">
            <div class="title_left">
                <h3>Dashboard</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row mt-4">
            <div class="col-md-12 col-sm-12  ">
                <div class="card">
                    <div class="card-body">
                        <marquee behavior="" direction="">
                            <h1>Selamat Datang {{ Auth::user()->name }}</h1>
                        </marquee>
                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card text-white" style="background-color: #C74B50">
                                    <a href="{{ route('kelola_barang') }}">
                                        <div class="card-body" style="color: white">
                                            <h5 class="text-center">Jumlah Barang Masuk</h5>
                                            <hr>
                                            @php
                                                $jumlah_masuk = DB::table('kelola_barang')->count();
                                            @endphp
                                            <h1 class="text-center"><i class="fa fa-table"></i>
                                                @if ($jumlah_masuk != null)
                                                    {{ $jumlah_masuk }}
                                                @else
                                                    {{ '0' }}
                                                @endif
                                            </h1>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <a href="{{ route('kelola_barang_keluar') }}">
                                        <div class="card-body text-white" style="background-color: #D9CE3F; color : white;">
                                            <h5 class="text-center">Jumlah Barang Keluar</h5>
                                            <hr>
                                            @php
                                                $jumlah_jual = DB::table('barang_keluar')->count();
                                            @endphp
                                            <h1 class="text-center"><i class="fa fa-table"></i>

                                                @if ($jumlah_jual != null)
                                                    {{ $jumlah_jual }}
                                                @else
                                                    {{ '0' }}
                                                @endif

                                            </h1>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <a href="{{ route('laporan_expired') }}">
                                        <div class="card-body text-white" style="background-color: #541690">
                                            <h5 class="text-center">Jumlah Barang Expired</h5>
                                            <hr>
                                            @php
                                                date_default_timezone_set('Asia/Jakarta');
                                                $tgl = date('Y-m-d');
                                                $jumlah_expired = DB::table('kelola_barang')
                                                    ->leftjoin('histori_stok', 'kelola_barang.kode_barang', '=', 'histori_stok.kode_barang')
                                                    ->select(DB::raw('count(histori_stok.id_histori_stok) as barang_expired'))
                                                    ->where('histori_stok.tanggal_expired', '<=', $tgl)
                                                    ->first();
                                            @endphp
                                            <h1 class="text-center"><i class="fa fa-table"></i>
                                                @if ($jumlah_expired != null)
                                                    {{ $jumlah_expired->barang_expired }}
                                                @else
                                                    {{ '0' }}
                                                @endif
                                            </h1>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- /.content -->
    </div>

@endsection
