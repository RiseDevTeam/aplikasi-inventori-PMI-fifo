@extends('tampilan.admin')

@section('title_admin', 'Tampilan Index')

@section('admin')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <h1><i class="fas fa-history"></i> Histori Stok</h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Histori Stok</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">

            <div class="card card-danger card-outline">
                <div class="card-header">
                    <div class="card-title">
                    </div>
                    @php
                        date_default_timezone_set('Asia/Jakarta');
                        $tgl = date('m');
                    @endphp
                    <form action="{{ route('cari') }}" method="POST">
                        @csrf
                        <div class="float-center">

                            <select class="form-control mb-2" name="periode" aria-label="Default select example">
                                @php
                                    $bulan = ['Januari' => '1', 'Februari' => '2', 'Maret' => '3', 'April' => '4', 'Mei' => '5', 'Juni' => '6', 'Juli' => '7', 'Agustus' => '8', 'September' => '9', 'Oktober' => '10', 'November' => '11', 'Desember' => '12'];
                                @endphp
                                <option value="{{ $tgl }}">Pilih Bulan</option>
                                @foreach ($bulan as $b => $value_bulan)
                                    <option value="{{ $value_bulan }}">{{ $b }} </option>
                                @endforeach

                            </select>
                            <button type="submit" class="btn btn-danger my-2">Cari</button>

                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example2">
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    date_default_timezone_set('Asia/Jakarta');
                                    $tgl = date('Y-m-d');
                                @endphp
                                @foreach ($histori as $i)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $i->user->name }}</td>
                                        <td>{{ $i->kode_barang }}</td>
                                        <td>{{ $i->nama_barang }}</td>
                                        <td>{{ $i->stok_awal }}</td>
                                        <td>{{ $i->stok }}</td>
                                        <td>{{ date('d-m-Y', strtotime($i->tanggal_input)) }}</td>
                                        <td>
                                            @if ($i->tanggal_expired == null)
                                                {{ '-' }}
                                            @else
                                                {{ date('d-m-Y', strtotime($i->tanggal_expired)) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($i->tanggal_expired == null)
                                                {{ $i->keterangan }}
                                            @elseif($i->tanggal_expired <= $tgl)
                                                <h5> <span class="badge badge-danger">{{ 'Stok Sudah Expired' }}</span>
                                                </h5>
                                            @else
                                                {{ $i->keterangan }}
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('laporan_masuk_delete', $i->id_histori_stok) }}"
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
