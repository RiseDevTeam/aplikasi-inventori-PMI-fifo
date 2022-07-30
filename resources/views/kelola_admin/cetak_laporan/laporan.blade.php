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
            <h2> Laporan Akhir Aplikasi Inventori</h2>
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
                            <th>Kode Barang</th>
                            <th>Nama Nama Barang</th>
                            <th>Jumlah Stok Keluar</th>
                            <th>Jumlah Stok Tesisa</th>
                            <th>Tanggal Barang Keluar</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($laporan_cetak as $i)
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
