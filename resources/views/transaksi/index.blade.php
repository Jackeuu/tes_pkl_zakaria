@extends('master')
@section('konten')

    <div class="row">
        <!-- ===================== BAGIAN DAFTAR BARANG ===================== -->
        <div class="col-md-8">
            <h4 class="mb-3">Daftar Barang</h4>

            <div class="row">
                @foreach($barang as $b)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            @if(isset($b->gambar))
                                <img src="{{ asset('assets/img/storage/' . $b->gambar) }}" class="card-img-top"
                                    style="height: 150px; object-fit: cover;">
                            @else
                                <div class="text-center py-5 text-muted">Tidak Ada Gambar</div>
                            @endif

                            <div class="card-body">
                                <h6 class="card-title">{{ $b->nama_barang }}</h6>
                                <p class="card-text mb-1">Harga: <b>Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</b></p>
                                <p class="card-text text-secondary" style="font-size: 13px;">Stok: {{ $b->stok }}</p>

                                <a href="/transaksi/tambah/{{ $b->idb }}" class="btn btn-primary w-100">
                                    + Tambah ke Keranjang
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ===================== BAGIAN KERANJANG ===================== -->
        <div class="col-md-4">
            <h4 class="mb-3">Keranjang</h4>

            <div class="card shadow-sm">
                <div class="card-body">

                    @if($keranjang->isEmpty())
                        <p class="text-center text-muted">Keranjang masih kosong</p>
                    @else
                        @foreach($keranjang as $item)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <div>
                                    <strong>{{ $item->barang->nama_barang }}</strong>
                                    <br>
                                    <small>Rp {{ number_format($item->barang->harga_jual, 0, ',', '.') }}</small>
                                </div>

                                <div class="d-flex align-items-center">
                                    <a href="/transaksi/kurang/{{ $item->idb }}" class="btn btn-sm btn-warning me-2">−</a>
                                    <span>{{ $item->qty }}</span>
                                    <a href="/transaksi/tambah/{{ $item->idb }}" class="btn btn-sm btn-success ms-2">+</a>
                                    <a href="/transaksi/hapus/{{ $item->idb }}" class="btn btn-sm btn-danger ms-3">Hapus</a>

                                </div>
                            </div>
                        @endforeach

                        <hr>

                        <h5>Total: <b>Rp {{ number_format($total, 0, ',', '.') }}</b></h5>

                        <form action="/transaksi/checkout" method="POST">
                            @csrf
                            <div class="mb-2">
                                <label>Uang Dibayar</label>
                                <input type="number" name="bayar" id="bayar" class="form-control" required>
                            </div>

                            <div class="mb-2">
                                <label>Kembalian</label>
                                <input type="text" id="kembalian" class="form-control" readonly>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success w-100">
                                Checkout
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <script>
        const inputBayar = document.getElementById('bayar');
        const inputKembalian = document.getElementById('kembalian');
        const total = {{ $total }};

        inputBayar?.addEventListener('input', function () {
            let kembali = this.value - total;
            inputKembalian.value = kembali > 0 ? kembali : 0;
        });
    </script>

@endsection