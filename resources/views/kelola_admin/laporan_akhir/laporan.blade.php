@extends('tampilan.admin')

@section('title_admin', 'Tampilan Index')

@section('admin')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <h1>
                            <i class="fas fa-tasks"> Laporan Akhir</i>
                        </h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Laporan Akhir</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">

            <div class="card card-danger card-outline">
                <div class="card-header">
                    <div class="card-title">
                        <a href="{{ route('cetak_laporan') }}" target="_blank" class="btn btn-danger"><i
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
                                    <th>Kode Barang</th>
                                    <th>Nama Nama Barang</th>
                                    <th>Jumlah Stok Keluar</th>
                                    <th>Jumlah Stok Tesisa</th>
                                    <th>Tanggal Barang Keluar</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($laporan as $i)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $i->name }}</td>
                                        <td>{{ $i->kode_barang }}</td>
                                        <td>{{ $i->nama_barang }}</td>
                                        <td>{{ $i->stok_keluar }}</td>
                                        <td>{{ $i->stok }}</td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($i->tanggal_barang_keluar)) }}
                                        </td>
                                        <td> 
                                            {{-- <form action="{{ route('laporan_delete', $i->id_laporan) }}"
                                                method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-block btn-danger"> <i class="fas fa-trash">
                                                    </i> Delete</button>
                                            </form> --}}
                                            
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
