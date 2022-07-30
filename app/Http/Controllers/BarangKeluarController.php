<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\StokBarang;
use App\Models\BarangKeluar;
use App\Models\Histori_stok;
use App\Models\KelolaBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $BarangKeluar = BarangKeluar::join('users', 'barang_keluar.id_user', '=', 'users.id')->join('kelola_barang', 'barang_keluar.kode_barang', '=', 'kelola_barang.kode_barang')
            ->select('users.name', 'barang_keluar.*', 'kelola_barang.nama_barang')->get();
        return view('kelola_admin.barang_keluar.index', compact('BarangKeluar'));
    }

    public function create()
    {
        $KelolaBarang = KelolaBarang::all();
        return view('kelola_admin.barang_keluar.tambah', compact('KelolaBarang'));
    }

    public function ajax_jual()
    {
        // untuk menglihatkan data stok tersisa pada sistem ketika memilih barang
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d');
        if ($_POST['barang']) {
            $ajax = KelolaBarang::where('nama_barang', '=', $_POST['barang'])->leftjoin('stok_barang', 'kelola_barang.kode_barang', '=', 'stok_barang.kode_barang')
                ->leftjoin('histori_stok', 'kelola_barang.kode_barang', '=', 'histori_stok.kode_barang')
                ->select('kelola_barang.*', 'kelola_barang.kode_barang as kode_i', 'stok_barang.stok as stok_tersedia', 'histori_stok.tanggal_expired', 'histori_stok.tanggal_input', 'histori_stok.stok as stok_histori', 'stok_barang.id_stok')->first();

            // mengambil stok/ jumlah barang yg expire
            $stokExpire =  Histori_stok::where('tanggal_expired', '<=', $tgl)
                ->sum('stok');
            return response()->json([
                "ajax" => $ajax,
                "stokExp" => $stokExpire
            ]);
            # code...
        }
    }

    public function store(Request $request)
    {
        // input data ke database barang masuk
        $store = new BarangKeluar;
        $store->id_user = Auth::user()->id;
        $store->id_stok = $request->id_stok;
        $store->kode_barang = $request->kode_barang;
        $store->stok_keluar = $request->stok_keluar;
        $store->tanggal_barang_keluar = $request->tanggal_barang_keluar;
        $store->save();
        $id_barang_keluar = $store->id_barang_keluar;

        //update data master stok ketika stok barang di keluarkan

        $stok = StokBarang::where('kode_barang', $request->kode_barang)->get();

        foreach ($stok as $key) {
            $key->update([
                'stok' => $key->stok - $request->stok_keluar
            ]);
        }

        //end update data master stok ketika stok barang di keluarkan

        // histori stok terupdate dan barang keluar bertambah ketika request stok keluar

        if ($request->stok_keluar) {

            $histori_kurang = Histori_stok::where('kode_barang', $request->kode_barang)->orderBy('tanggal_input')->get();
            $total_stok = $histori_kurang->sum("stok");
            // proses FIFO
            $tgl = date('Y-m-d');
            foreach ($histori_kurang as $t) {
                // echo "$t->tanggal_expired <br>";

                // cek apakah barang sudah expire atau belum,
                // jika sudah stoknya tidak akan dikurangi..
                // yang dikurangi hanya barang yg tidak expire

                // if ($t->tanggal_expired <= $tgl) {
                if ($t->stok < $request->stok_keluar) {
                    $h = $request->stok_keluar -= $t->stok;
                    // $this->insertDetail($id, $request, $t->stok, $request);
                    Laporan::create([
                        'id_barang_keluar' => $id_barang_keluar,
                        'id_stok' => $request->id_stok,
                        "id_histori_stok" => $t->id_histori_stok,
                        'kode_barang' => $request->kode_barang,
                    ]);
                    $t->update([
                        "stok" => 0
                    ]);
                } else if ($request->stok_keluar < $total_stok) {
                    // $this->insertDetail($id_barang_keluar, $request, $t->stok - $request->stok_keluar);
                    Laporan::create([
                        'id_barang_keluar' => $id_barang_keluar,
                        'id_stok' => $request->id_stok,
                        "id_histori_stok" => $t->id_histori_stok,
                        'kode_barang' => $request->kode_barang,
                    ]);
                    if ($t->stok >= $request->stok_keluar) {
                        $t->update([
                            "stok" => $t->stok - $request->stok_keluar
                        ]);
                        Alert::success('Barang Keluar Berhasil', 'Data Berhasil Ditambahkan');
                        return redirect()->route('kelola_barang_keluar');
                    }
                } else {
                    // $this->insertDetail($id_barang_keluar, $request, $t->stok - $request->stok_keluar, $request);
                    Laporan::create([
                        'id_barang_keluar' => $id_barang_keluar,
                        'id_stok' => $request->id_stok,
                        "id_histori_stok" => $t->id_histori_stok,
                        'kode_barang' => $request->kode_barang,
                    ]);
                    $t->update([
                        "stok" => $t->stok - $request->stok_keluar
                    ]);
                }
                // }
            }
            // dd($t->tanggal_expired);
        }

        // end histori stok terupdate dan detail penjualan bertambah ketika request stok jual

        Alert::success('Barang Keluar Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('kelola_barang_keluar');
    }

    public function destroy_barang_keluar($id_barang_keluar)
    {
        $delete = BarangKeluar::where('id_barang_keluar', $id_barang_keluar)->first();
        $StokBarang = StokBarang::where('kode_barang', $delete->kode_barang)->first();
        StokBarang::where('kode_barang', $delete->kode_barang)->update([
            'stok' => $StokBarang->stok + $delete->stok_keluar,
        ]);
        $delete->delete();

        $deleteLaporan = Laporan::where('id_barang_keluar', $id_barang_keluar);
        $deleteLaporan->delete();

        Alert::success('Kelola Barang Keluar Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('kelola_barang_keluar');
    }
}
