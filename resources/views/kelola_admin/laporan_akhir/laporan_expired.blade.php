@extends('tampilan.admin')

@section('title_admin', 'Tampilan Index')

@section('admin')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <h1>
                            <i class="fas fa-tasks"> Laporan Barang Expired</i>
                        </h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Laporan Barang Expired</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">

            <div class="card card-danger card-outline">
                <div class="card-header">
                    <div class="card-title">
                        <a href="{{ route('cetak_laporan_expired') }}" target="_blank" class="btn btn-danger"><i
                                class="fas fa-print"></i>
                            Print</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1">
                            <thead>
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>Nama Admin</th>
                                    <th>Kode barang</th>
                                    <th>Nama barang</th>
                                    <th>Master Stok</th>
                                    <th>Stok Tersedia</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Expired</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($laporan_expired as $i)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $i->user->name }}</td>
                                        <td>{{ $i->kode_barang }}</td>
                                        <td>{{ $i->nama_barang }}</td>
                                        <td>{{ $i->stok_awal }}</td>
                                        <td>{{ $i->stok }}</td>
                                        <td>{{ date('d-m-Y', strtotime($i->tanggal_input)) }}</td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($i->tanggal_expired)) }}
                                        </td>
                                        <td>
                                            <h5> <span class="badge badge-danger">{{ 'Stok Sudah Expired' }}</span>
                                            </h5>
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
