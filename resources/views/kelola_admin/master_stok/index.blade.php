@extends('tampilan.admin')

@section('title_admin', 'Tampilan Index')

@section('admin')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <h1>
                            <i class="fas fa-boxes"> Kelola Stok</i>
                        </h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Kelola Stok</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <!-- Default box -->
            <a href="{{ route('stok_tambah') }}" class="btn btn-sm btn-primary mb-2"><i class="fas fa-plus"></i> Tambah
                Data</a>

            <div class="card card-danger card-outline">
                <div class="card-header">
                    <div class="card-title">Kelola Stok Barang</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1">
                            <thead>
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>Nama Admin</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Total Master Stok/ Stok Awal</th>
                                    <th>Total Stok Expired</th>
                                    <th>Total Stok Tersedia</th>

                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $i)
                                    @php
                                        $tgl = date('Y-m-d');
                                        
                                        // menghitung stok yg expired
                                        $stok_expired = DB::table('histori_stok')
                                            ->where('tanggal_expired', '<=', $tgl)
                                            ->where('kode_barang', '=', $i->kode_barang)
                                            ->sum('stok');
                                        
                                        // menghitung stok yang tersedia untuk dikeluarkan
                                        $stok_tersedia = $i->stok - $stok_expired;
                                    @endphp

                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $i->user->name }}</td>
                                        <td>{{ $i->kode_barang }}</td>
                                        <td>{{ $i->nama_barang }}</td>
                                        <td>{{ $i->stok_awal }}</td>
                                        <td>{{ $stok_expired }}</td>
                                        <td>
                                            @if ($stok_tersedia >= '0')
                                                {{ $stok_tersedia }}
                                            @else
                                                {{ '0' }}
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('stok_edit', $i->id_stok) }}"
                                                class="btn btn-block btn-info mb-2"><i class="fas fa-edit"></i>Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
