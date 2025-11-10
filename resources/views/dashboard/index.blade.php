@extends('master')
@section('konten')

    <div class="container">
        <h4 class="mb-3">Selamat Datang di Dashboard</h4>
        <p>Toko Kelontong, Haji Sarboah</p>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-center bg-light">
                    <div class="card-body">
                        <h5>Total Pengguna</h5>
                        <h2>{{ $totaluser }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center bg-light">
                    <div class="card-body">
                        <h5>Total Barang</h5>
                        <h2>{{ $totalbarang }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center bg-light">
                    <div class="card-body">
                        <h5>Total Transaksi</h5>
                        <h2>{{ $totaltransaksi }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection