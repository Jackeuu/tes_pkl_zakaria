@extends('master')
@section('konten')
    <div class="card">
        <div class="card-datatable text-nowrap">
            <div class="dt-container dt-bootstrap5 dt-empty-footer">
                <div class="row card-header flex-column flex-md-row pb-0">
                    <div
                        class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto ma-auto mt-0">
                    </div>
                    <div
                        class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ms-auto mt-0">
                    </div>
                </div>
                <div class="container mt-4">
                    <h3>Riwayat Transaksi{{ $transaksi->id }}</h3>
                    <p>Total: <b>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</b></p>
                    <p>Bayar: <b>Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</b></p>
                    <p>Kembalian: <b>Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</b></p>
                    <hr>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi->detailTransaksi as $detail)
                                <tr>
                                    <td>{{ $detail->barang->nama_barang }}</td>
                                    <td>{{ $detail->qty }}</td>
                                    <td>Rp {{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <a href="{{ route('transaksi.cetak', $transaksi->id_transaksi) }}" class="btn btn-success">Cetak
                        Struk</a>
                    <a href="{{ route('transaksi.daftar') }}" class="btn btn-secondary">Kembali</a>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>


@endsection