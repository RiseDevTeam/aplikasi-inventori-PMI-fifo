@extends('tampilan.admin')

@section('title_admin', 'Tambah Stok')

@section('admin')

    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <h1><i class="fas fa-balance-scale">Kelola Barang Keluar</i></h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Kelola Barang Keluar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <!-- Default box -->

            <form action="{{ route('pengeluaran_stok') }}" method="POST">
                @csrf
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <div class="card-title">Barang Keluar</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-10">
                                <input type="hidden" name="id_stok" id="id_stok">

                                <div class="row" id="kode">

                                </div>

                                <div class="row mt-2 mb-2" id="tanggal">

                                </div>

                                {{-- List Detail Stok --}}
                                <div class="row mt-2 mb-2" >
                                    <table id="detailStok">
                                        
                                    </table>
                                    
                                </div>

                                <div class="form-group">
                                    @php
                                        date_default_timezone_set('Asia/Jakarta');
                                        $tgl = date('Y-m-d');
                                    @endphp
                                    <label for="">Nama Barang</label>
                                    <select class="form-control" onchange="barang(this);"
                                        aria-label="Default select example">
                                        <option selected>Nama barang</option>
                                        @foreach ($KelolaBarang as $t)
                                            @if ($t->tanggal_expired > $tgl || $t->tanggal_expired == '')
                                                <option value="{{ $t->nama_barang }}">{{ $t->nama_barang }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('nama_tanaman')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Pengeluaran Stok </label>
                                    <input type="text" name="stok_keluar" id="pengeluaran" value="{{ old('stok_keluar') }}"
                                        class="form-control form-control-sm" placeholder="Jumlah stok yang dijual" oninput="cekPengeluaran()" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" name="tanggal_barang_keluar"
                                        value="{{ old('tanggal_barang_keluar') }}" class="form-control form-control-sm"
                                        required>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('kelola_barang_keluar') }}" class="btn btn-warning">Back</a>
                    </div>
                </div>
            </form>
        </section>
        <!-- /.content -->
    </div>

    <script type="text/javascript">

        let stokTersedia = 0;
        
        function barang(val) {
            $.ajax({
                url: "{{ route('ajax_jual') }}",
                type: 'POST',
                datatype: 'JSON',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "barang": val.value,
                },

                success: function(response) {
                    // console.log(response);
                    $('#harga_jual').val(response.harga_jual)
                    $('#kualitas').val(response.kualitas)
                    let data = response.ajax;
                    let stokExp = response.stokExp;
                    let view = "";
                    let view1 = "";

                    stokTersedia = data.stok_tersedia - stokExp;

                    view = `<div class="col">
                                <label for=""> Kode barang</label>
                                <input type="hidden" name="id_stok" value="${data.id_stok}">
                                <input type="text" name="kode_barang" class="form-control"
                                    placeholder="Kode Tanaman" value="${data.kode_barang}" readonly>
                            </div>
                            <div class="col">
                                <label for=""> &nbsp; Stok Tersedia </label>
                                <input type="text" class="form-control" value="${stokTersedia}" placeholder="Stok Tersedia" readonly>
                            </div>`

                    document.getElementById('kode').innerHTML = view;
                    document.getElementById('tanggal').innerHTML = view1;
                    
                    console.log(val.value)
                    detailStok(val.value)
                }
            })
        }

        // fungsi untuk menampilkan detail stok barang
        function detailStok(val) {
            $.ajax({
                url: "{{ route('ajax_detail_stok') }}",
                type: 'POST',
                datatype: 'JSON',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "barang": val,
                },

                success: function(response) {
                    let data = response.ajax;
                    let viewDetail = "";

                    viewDetail = `
                        <tr>
                            <td> &nbsp; Master Stok </td>
                            <td> &nbsp; Stok Tersedia </td>
                            <td> &nbsp; Tanggal Masuk </td>
                        </tr>
                    `;

                    data.forEach(item => {
                        viewDetail += `
                            <tr>
                                <td>
                                    <div class="col">
                                        <input type="text" class="form-control"
                                            value="${item.stok_awal}" readonly>
                                    </div>
                                </td>
                                <td>
                                    <div class="col">
                                        <input type="text" class="form-control"
                                            value="${item.stok}" readonly>
                                    </div>
                                </td>
                                <td>
                                    <div class="col">
                                        <input type="text" class="form-control"
                                            value="${new Date(item.tanggal_input).toLocaleDateString("id")}" readonly>
                                    </div>
                                </td>
                            </tr>
                            `
                    });

                    document.getElementById('detailStok').innerHTML = viewDetail;

                }
            })
        }

        

        // (validasi) alert ketika pengeluaran stok lebih besar dari stok yg tersedia
        function cekPengeluaran(){
            var x = document.getElementById("pengeluaran").value;
            if(x > stokTersedia){
                alert('Jumlah Pengeluaran Stok tidak boleh melebihi stok yang tersedia!!!');
                document.getElementById("pengeluaran").value = "";
            }
        }
    </script>

@endsection
