<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\User;
use App\Models\DetailTransaksi;

class DashboardController extends Controller
{
    public function index(){

        $totaluser = User::count();
        $totalbarang = Barang::count();
        $totaltransaksi = DetailTransaksi::count();

        return view('dashboard.index', compact('totaluser', 'totalbarang', 'totaltransaksi'));
    }
}
