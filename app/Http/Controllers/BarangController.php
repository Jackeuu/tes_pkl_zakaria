<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // ✅ pastikan hanya user login bisa akses
    }

    public function index()
    {
        $barang = DB::table('tbarang')
            ->where('id_users', auth()->user()->id_users)
            ->get();

        return view('barang.index', compact('barang'));
    }
    public function store(Request $request)
    {
        $img_name = 'photo.img';

        if ($request->hasFile('gambar')) {
            $foto = $request->file('gambar');
            $img_name = now()->format('d-m-Y') . $foto->hashName();
            $foto->move(public_path('assets/img/storage'), $img_name);
        }

        DB::table('tbarang')->insert([
            'id_users' => auth()->user()->id_users,
            'nama_barang' => $request->nama_barang,
            'harga_modal' => $request->harga_modal,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'gambar' => $img_name,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $idb)
    {
        $img_name = $request->old_image; // default pakai gambar lama

        if ($request->hasFile('gambar')) {
            $foto = $request->file('gambar');
            $img_name = now()->format('d-m-Y') . $foto->hashName();
            $foto->move(public_path('assets/img/storage'), $img_name);
        }

        DB::table('tbarang')->where('idb', $idb)->update([
            'nama_barang' => $request->nama_barang,
            'harga_modal' => $request->harga_modal,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'gambar' => $img_name,
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        DB::table('tbarang')->where('idb', $id)->delete();
        return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
    }


}
