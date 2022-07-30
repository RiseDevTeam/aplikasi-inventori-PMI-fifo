<?php

namespace App\Http\Controllers;

use App\Models\KelolaBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class KelolaBarangController extends Controller
{
    public function index()
    {
        $index = KelolaBarang::all();
        return view('kelola_admin.kelola_barang.index', compact('index'));
    }


    public function create()
    {
        return view('kelola_admin.kelola_barang.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:kelola_barang,kode_barang',
        ]);

        $store = new KelolaBarang;

        $store->id_user = Auth::user()->id;
        $store->kode_barang = $request->kode_barang;
        $store->nama_barang = $request->nama_barang;
        $store->save();
        Alert::success('Kelola barang Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('kelola_barang');
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
    public function edit($id_kelola_barang)
    {
        $edit = KelolaBarang::join('users', 'kelola_barang.id_user', '=', 'users.id')->where('id_kelola_barang', $id_kelola_barang)->first();
        // dd($edit);
        return view('kelola_admin.kelola_barang.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kelola_barang)
    {

        KelolaBarang::where('id_kelola_barang', $id_kelola_barang)->update([
            'id_user' => Auth::user()->id,
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
        ]);

        Alert::success('Kelola Barang Berhasil', 'Data Berhasil Diupdate');
        return redirect()->route('kelola_barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kelola_barang)
    {
        $delete = KelolaBarang::where('id_kelola_barang', $id_kelola_barang);

        $delete->delete();

        Alert::error('Kelola Barang Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('kelola_barang');
    }
}
