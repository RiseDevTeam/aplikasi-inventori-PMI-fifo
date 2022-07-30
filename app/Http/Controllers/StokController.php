<?php

namespace App\Http\Controllers;

use App\Models\Histori_stok;
use App\Models\KelolaBarang;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $index = StokBarang::leftjoin('kelola_barang', 'stok_barang.kode_barang', '=', 'kelola_barang.kode_barang')->select('stok_barang.*', 'kelola_barang.nama_barang')->get();
        
        return view('kelola_admin.master_stok.index', compact('index'));
    }

    public function histori()
    {
        $histori = Histori_stok::leftjoin('users', 'histori_stok.id_user', 'users.id')->leftjoin('kelola_barang', 'histori_stok.kode_barang', '=', 'kelola_barang.kode_barang')
            ->select('histori_stok.*', 'users.name', 'kelola_barang.nama_barang')->get();
        return view('kelola_admin.histori_stok.index', compact('histori'));
    }

    public function cari(Request $request)
    {
        $cari = Histori_stok::leftjoin('users', 'histori_stok.id_user', 'users.id')->leftjoin('kelola_barang', 'histori_stok.kode_barang', '=', 'kelola_barang.kode_barang')
            ->select('histori_stok.*', 'kelola_barang.nama_barang');

        if ($request->periode) {
            $data = $cari->whereMonth('histori_stok.tanggal_input', [$request->periode]);
        } else {
            $data = $cari;
        }
        $histori = $data->get();
        return view('kelola_admin.histori_stok.index', compact('histori'));
    }

    public function create()
    {
        $kelola_barang = KelolaBarang::all();
        return view('kelola_admin.master_stok.tambah', compact('kelola_barang'));
    }

    public function ajax_stok()
    {
        if (isset($_POST['stok'])) {

            $res = array();
            $input = KelolaBarang::where('nama_barang', $_POST['stok'])->first();
            $res = array('kode_barang' => $input->kode_barang);
            return response()->json($res);
        }
    }

    public function store(Request $request)
    {

        $stok_barang = StokBarang::where('kode_barang', $request->kode_barang)->first();
        if ($stok_barang == NULL) {
            $tambah = new StokBarang;
            $tambah->id_user = Auth::user()->id;
            $tambah->kode_barang = $request->kode_barang;
            $tambah->stok = $request->stok;
            $tambah->stok_awal = $request->stok;
            $tambah->save();

            $histori = new Histori_stok;
            $histori->id_user = Auth::user()->id;
            $histori->kode_barang = $request->kode_barang;
            $histori->stok_awal = $request->stok;
            $histori->stok = $request->stok;
            $histori->tanggal_input = $request->tanggal_input;
            $histori->tanggal_expired = $request->tanggal_expired;
            $histori->keterangan = 'Tambah Data';
            $histori->save();

            Alert::success('Stok Berhasil', 'Data Berhasil Ditambahkan');
            return redirect()->route('kelola_stok');
        } elseif ($stok_barang->kode_barang == $request->kode_barang) {
            StokBarang::where('kode_barang', $request->kode_barang)->update([
                'stok' => $request->stok + $stok_barang->stok,
                'stok_awal' => $request->stok + $stok_barang->stok_awal,
            ]);

            $histori = new Histori_stok;
            $histori->id_user = Auth::user()->id;
            $histori->kode_barang = $request->kode_barang;
            $histori->stok_awal = $request->stok;
            $histori->stok = $request->stok;
            $histori->tanggal_input = $request->tanggal_input;
            $histori->tanggal_expired = $request->tanggal_expired;
            $histori->keterangan = 'Tambah Data';
            $histori->save();

            Alert::success('Stok Berhasil', 'Data Berhasil Ditambahkan');
            return redirect()->route('kelola_stok');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_stok)
    {
        $edit = StokBarang::leftjoin('kelola_barang', 'stok_barang.kode_barang', '=', 'kelola_barang.kode_barang')->select('stok_barang.*', 'kelola_barang.kode_barang', 'kelola_barang.nama_barang')->where('id_stok', $id_stok)
            ->first();
        return view('kelola_admin.master_stok.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_stok)
    {
        $stok_kurang = StokBarang::where('id_stok', $id_stok)->first();

        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d');
        StokBarang::where('id_stok', $id_stok)->update([
            'stok_awal' => $stok_kurang->stok_awal - $request->stok,
            'stok' => $stok_kurang->stok - $request->stok
        ]);

        $histori = new Histori_stok;
        $histori->id_user = Auth::user()->id;
        $histori->kode_barang = $request->kode_barang;
        $histori->stok_awal = $request->stok;
        $histori->stok = $request->stok;
        $histori->tanggal_input = $tgl;
        $histori->keterangan = 'Mengurangi Data';
        $histori->save();

        Alert::success('Stok Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('kelola_stok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
