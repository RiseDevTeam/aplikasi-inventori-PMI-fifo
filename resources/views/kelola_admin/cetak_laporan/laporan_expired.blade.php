<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('layouts.navbar')
</head>
@include('layouts.script')

<body onload="print();">
    {{-- <section class="content"> --}}
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <h2> Laporan Expired Aplikasi Inventori</h2>
        </div>
        <div class="card-header">
            <div class="card-title">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
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

                        @foreach ($laporan_cetak_expired as $i)
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
                @php
                    $tgl = date('d-m-Y');
                @endphp

            </div>
        </div>
        {{-- </section> --}}
        <div class="d-flex justify-content-end">
            Padang, {{ $tgl }}
            <br> Hormat Kami
            <br> <br><br><br><br>
            Palang Merah Indonesia
        </div>
    </div>


</body>

</html>
