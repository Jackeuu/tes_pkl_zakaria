<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class TransaksiController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        $keranjang = Keranjang::with('barang')->get();

        $total = Keranjang::join('tbarang', 'keranjang.idb', '=', 'tbarang.idb')
            ->selectRaw('SUM(keranjang.qty * tbarang.harga_jual) as total')
            ->value('total') ?? 0;

        $transaksi = null;
        if (session('transaksi_id')) {
            $transaksi = Transaksi::with('detailTransaksi.barang')->find(session('transaksi_id'));
        }

        return view('transaksi.index', compact('barang', 'keranjang', 'total', 'transaksi'));
    }


    public function tambahKeranjang($id)
    {
        $item = Barang::findOrFail($id);

        $item = Keranjang::where('idb', $id)->first();
        if ($item) {
            $item->qty += 1;
            $item->save();
        } else {
            Keranjang::create([
                'idb' => $id,
                'qty' => 1,
            ]);
        }

        return back();
    }

    public function kurangKeranjang($id)
    {
        $item = Keranjang::where('idb', $id)->first();

        if ($item) {
            if ($item->qty > 1) {
                $item->qty -= 1;
                $item->save();
            } else {
                $item->delete();
            }
        }

        return back();
    }

    public function hapusKeranjang($id)
    {
        Keranjang::where('idb', $id)->delete();
        return back();
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'bayar' => 'required|numeric|min:0'
        ]);

        $keranjang = Keranjang::with('barang')->get();

        if ($keranjang->isEmpty()) {
            return back()->with('error', 'Keranjang masih kosong!');
        }

        DB::transaction(function () use($keranjang, $request) {
            $total_harga = $keranjang->sum(fn($item) => $item->qty * $item->barang->harga_jual);

            $transaksi = Transaksi::create([
                'total_harga' => $total_harga,
                'bayar' => $request->bayar,
                'kembalian' => $request->bayar - $total_harga,
            ]);

            foreach ($keranjang as $item) {
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'idb' => $item->idb,
                    'qty' => $item->qty,
                    'harga_jual' => $item->barang->harga_jual,
                    'subtotal' => $item->qty * $item->barang->harga_jual,
                ]);

                $item->barang->stok -= $item->qty;
                $item->barang->save();
            }
        });

        DB::statement("DELETE FROM keranjang");

        return redirect()->back()->with('success', 'Pembayaram berhasil!');
    }

    public function resetKeranjang()
    {
        Keranjang::truncate();
        return redirect()->route('transaksi.index');
    }

    // 🔽 Tambahkan fungsi baru ini di bawah checkout:
    public function showRiwayat($id)
    {
        $transaksi = Transaksi::with('detailTransaksi.barang')->findOrFail($id);
        return view('transaksi.riwayat', compact('transaksi'));
    }


    // 🔽 Dan fungsi ini untuk cetak PDF
    public function cetakStruk($id)
    {
        $transaksi = Transaksi::with('detailTransaksi.barang')->findOrFail($id);

        $pdf = Pdf::loadView('transaksi.struk_pdf', compact('transaksi'))
            ->setPaper('A5', 'portrait');

        return $pdf->download('struk-transaksi-' . $id . '.pdf');
    }

    public function riwayatSemua()
    {
        // Ambil semua transaksi terbaru beserta detail dan barangnya
        $transaksi = Transaksi::with('detailTransaksi.barang')->orderBy('created_at', 'desc')->get();

        return view('transaksi.daftar_riwayat', compact('transaksi'));
    }

    public function daftarRiwayat()
    {
        $transaksi = Transaksi::orderBy('created_at', 'desc')->get();
        return view('transaksi.daftar_riwayat', compact('transaksi'));
    }


}
