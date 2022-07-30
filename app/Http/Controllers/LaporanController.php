<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Penjualan;
use App\Models\Stok_ikan;
use App\Models\Kelola_ikan;
use App\Models\Histori_stok;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanController extends Controller
{
    public function laporan()
    {
        $laporan = Laporan::leftjoin('barang_keluar', 'laporan.id_barang_keluar', '=', 'barang_keluar.id_barang_keluar')
            ->leftjoin('stok_barang', 'laporan.id_stok', '=', 'stok_barang.id_stok')
            ->leftjoin('kelola_barang', 'laporan.kode_barang', '=', 'kelola_barang.kode_barang')->join('users', 'barang_keluar.id_user', '=', 'users.id')->select(
                'users.name',
                'barang_keluar.stok_keluar',
                'barang_keluar.tanggal_barang_keluar',
                'stok_barang.stok',
                'kelola_barang.*'
            )
            ->groupBy('barang_keluar.id_barang_keluar')
            ->get();
        return view('kelola_admin.laporan_akhir.laporan', compact('laporan'));
    }

    public function expired()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d');

        $laporan_expired =  Histori_stok::leftjoin('kelola_barang', 'histori_stok.kode_barang', '=', 'kelola_barang.kode_barang')->leftjoin('users', 'histori_stok.id_user', '=', 'users.id')
            ->select('users.name', 'kelola_barang.nama_barang', 'histori_stok.*')
            ->where('tanggal_expired', '<=', $tgl)->get();
        return view('kelola_admin.laporan_akhir.laporan_expired', compact('laporan_expired'));
    }

    public function laporan_masuk()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d');

        // $laporan_masuk = Histori_stok::leftjoin('users', 'histori_stok.id_user', 'users.id')->leftjoin('kelola_barang', 'histori_stok.kode_barang', '=', 'kelola_barang.kode_barang')
        //     ->select('histori_stok.*', 'users.name', 'kelola_barang.nama_barang')
        //     ->where('histori_stok.keterangan', '=', 'Tambah Data')
        //     ->where('tanggal_expired', '<=', $tgl)
        //     ->get();

        $laporan_masuk = Histori_stok::leftjoin('users', 'histori_stok.id_user', 'users.id')->leftjoin('kelola_barang', 'histori_stok.kode_barang', '=', 'kelola_barang.kode_barang')
            ->select('histori_stok.*', 'users.name', 'kelola_barang.nama_barang')
            ->where('histori_stok.keterangan', '=', 'Tambah Data')
            ->get();
        return view('kelola_admin.laporan_akhir.laporan_masuk', compact('laporan_masuk'));
    }


    public function cetak_laporan()
    {
        $laporan_cetak = Laporan::leftjoin('barang_keluar', 'laporan.id_barang_keluar', '=', 'barang_keluar.id_barang_keluar')
            ->leftjoin('stok_barang', 'laporan.id_stok', '=', 'stok_barang.id_stok')
            ->leftjoin('kelola_barang', 'laporan.kode_barang', '=', 'kelola_barang.kode_barang')->join('users', 'barang_keluar.id_user', '=', 'users.id')->select(
                'users.name',
                'barang_keluar.stok_keluar',
                'barang_keluar.tanggal_barang_keluar',
                'stok_barang.stok',
                'kelola_barang.*'
            )
            ->groupBy('barang_keluar.id_barang_keluar')
            ->get();
        return view('kelola_admin.cetak_laporan.laporan', compact('laporan_cetak'));
    }

    public function cetak_laporan_expired()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d');

        $laporan_cetak_expired =  Histori_stok::leftjoin('kelola_barang', 'histori_stok.kode_barang', '=', 'kelola_barang.kode_barang')->leftjoin('users', 'histori_stok.id_user', '=', 'users.id')
            ->select('users.name', 'kelola_barang.nama_barang', 'histori_stok.*')
            ->where('tanggal_expired', '<=', $tgl)->get();
        return view('kelola_admin.cetak_laporan.laporan_expired', compact('laporan_cetak_expired'));
    }

    public function cetak_laporan_masuk()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d');
        // $cetak_laporan_masuk = Histori_stok::leftjoin('users', 'histori_stok.id_user', 'users.id')->leftjoin('kelola_barang', 'histori_stok.kode_barang', '=', 'kelola_barang.kode_barang')
        // ->select('histori_stok.*', 'users.name', 'kelola_barang.nama_barang')
        // ->where('histori_stok.keterangan', '=', 'Tambah Data')
        // ->where('tanggal_expired', '<=', $tgl)
        // ->get();

        $cetak_laporan_masuk = Histori_stok::leftjoin('users', 'histori_stok.id_user', 'users.id')->leftjoin('kelola_barang', 'histori_stok.kode_barang', '=', 'kelola_barang.kode_barang')
            ->select('histori_stok.*', 'users.name', 'kelola_barang.nama_barang')
            ->where('histori_stok.keterangan', '=', 'Tambah Data')
            ->get();
        return view('kelola_admin.cetak_laporan.cetak_masuk', compact('cetak_laporan_masuk'));
    }


    // DELETE
    public function destroy_laporan_masuk($id_histori_stok)
    {
        $delete = Histori_stok::where('id_histori_stok', $id_histori_stok)->first();
        $stok_barang = StokBarang::where('kode_barang', $delete->kode_barang)->first();

        StokBarang::where('kode_barang', $delete->kode_barang)->update([
            'stok' => $stok_barang->stok - $delete->stok_awal,
            'stok_awal' => $stok_barang->stok_awal -  $delete->stok_awal,
        ]);
        $delete->delete();

        Alert::success('Histori Barang Masuk Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('histori');
    }
}
