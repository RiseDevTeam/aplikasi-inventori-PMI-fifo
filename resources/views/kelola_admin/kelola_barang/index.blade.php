@extends('tampilan.admin')

@section('title_admin', 'Tampilan Index')

@section('admin')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <h1><i class="fab fa-buffer mr-1 ml-1"></i> Kelola Barang</h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Kelola Barang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <!-- Default box -->
            <a href="{{ route('barang_tambah') }}" class="btn btn-sm btn-primary mb-2"><i class="fas fa-plus"></i>
                Tambah
                Data</a>

            <div class="card card-danger card-outline">
                <div class="card-header">
                    <div class="card-title">Kelola Barang</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1">
                            <thead>
                                <tr class="text-center">
                                    <th>Nomor</th>
                                    <th>Nama Admin</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                date_default_timezone_set('Asia/Jakarta');
                                $tgl = date('Y-m-d');
                                ?>
                                @foreach ($index as $i)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $i->user->name }}</td>
                                        <td>{{ $i->kode_barang }}</td>
                                        <td>{{ $i->nama_barang }}</td>
                                        <td>
                                            <a href="{{ route('barang_edit', $i->id_kelola_barang) }}"
                                                class="btn btn-block btn-info mb-2"><i class="fas fa-edit"></i>Edit</a>
                                            <form action="{{ route('barang_delete', $i->id_kelola_barang) }}"
                                                method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-block btn-danger"> <i class="fas fa-trash">
                                                    </i>Delete</button>
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
