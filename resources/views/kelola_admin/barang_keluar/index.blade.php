@extends('tampilan.admin')

@section('title_admin', 'Tampilan Index')

@section('admin')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <h1>
                            <i class="fas fa-balance-scale"> Kelola Barang Keluar</i>
                        </h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Kelola Barang Keluar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <!-- Default box -->
            <a href="{{ route('pengeluaran_stok') }}" class="btn btn-sm btn-primary mb-2"><i class="fas fa-plus"></i>
                Pengeluaran
                Stok Barang</a>

            <div class="card card-danger card-outline">
                <div class="card-header">
                    <div class="card-title">Kelola Stok Keluar</div>
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
                                    <th>Jumlah Stok Keluar</th>
                                    <th>Tanggal Stok Keluar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($BarangKeluar as $barang_keluar)
                                    {{-- @dd($barang_keluar) --}}
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $barang_keluar->name }}</td>
                                        <td>{{ $barang_keluar->kode_barang }}</td>
                                        <td>{{ $barang_keluar->nama_barang }}</td>
                                        <td>{{ $barang_keluar->stok_keluar }}</td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($barang_keluar->tanggal_barang_keluar)) }}
                                        </td>
                                        <td> 
                                            <form action="{{ route('barang_keluar_delete', $barang_keluar->id_barang_keluar) }}"
                                                method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-block btn-danger"> <i class="fas fa-trash">
                                                    </i> Delete</button>
                                            </form>
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
