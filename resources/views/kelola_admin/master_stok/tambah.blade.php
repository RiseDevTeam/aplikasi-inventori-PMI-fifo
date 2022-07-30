@extends('tampilan.admin')

@section('title_admin', 'Tambah Stok')

@section('admin')

    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <h1><i class="fas fa-boxes">Kelola Stok</i></h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Kelola Stok</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <!-- Default box -->

            <form action="{{ route('stok_tambah') }}" method="POST">
                @csrf
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <div class="card-title">Tambah data stok</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label for="">Kode Barang</label>
                                    <input type="text" name="kode_barang" class="form-control" id="kode" readonly>
                                </div>

                                <div class="form-group">
                                    @php
                                        
                                    @endphp
                                    <label for="">Nama Barang</label>
                                    <select class="form-control" onchange="barang(this);"
                                        aria-label="Default select example">
                                        <option selected>Nama Barang</option>
                                        @foreach ($kelola_barang as $t)
                                            <option value="{{ $t->nama_barang }}">{{ $t->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Stok barang</label>
                                    <input type="text" name="stok" class="form-control form-control-sm" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Tanggal Inputan</label>
                                    <input type="date" name="tanggal_input" id="" class="form-control form-control-sm"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="">Tanggal Expired</label> (boleh kosong)
                                    <input type="date" name="tanggal_expired" id="" class="form-control form-control-sm">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('kelola_stok') }}" class="btn btn-warning">Back</a>
                    </div>
                </div>
            </form>
        </section>
        <!-- /.content -->
    </div>

    <script>
        function barang(val) {
            $.ajax({
                url: "{{ route('ajax_stok') }}",
                type: 'POST',
                datatype: 'JSON',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "stok": val.value
                },

                success: function(response) {
                    console.log(response);
                    $('#kode').val(response.kode_barang)
                }
            })
        }
    </script>


@endsection
