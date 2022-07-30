@extends('tampilan.admin')

@section('title_admin', 'Tambah Tanaman')

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
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Kelola Barang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <!-- Default box -->

            <form action="{{ route('barang_tambah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <div class="card-title">Tambah Data Barang</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label for="">Kode barang</label>
                                    <input type="text" name="kode_barang" id="" class="form-control form-control-sm"
                                        required>
                                    @error('kode_barang')
                                        <small class="text-danger mt-3">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Nama Barang</label>
                                    <input type="text" name="nama_barang" id="" class="form-control form-control-sm"
                                        required>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('kelola_barang') }}" class="btn btn-warning">Back</a>
                    </div>
                </div>
            </form>
        </section>
        <!-- /.content -->
    </div>

@endsection
