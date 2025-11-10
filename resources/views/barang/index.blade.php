@extends('master')

@section('konten')
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <!-- Header -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-2 mb-md-0 fw-semibold text-gray-800">Data Barang</h5>

                <x-modal modalId="tambahbarang" buttonText="+ Tambah Barang" title="Tambah Barang" url="barang/store"
                    method="post" btnTutup="simpan data">

                    <div class="mb-3">
                        <label class="form-label">Nama Kasir</label>
                        <input type="text" id="nama_kasir" class="form-control" value="{{ auth()->user()->name }}"
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama barang" name="nama_barang">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Modal</label>
                        <input type="number" class="form-control" placeholder="Masukkan Harga Modal" name="harga_modal">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Jual</label>
                        <input type="number" class="form-control" placeholder="Masukkan Harga Jual" name="harga_jual">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control" placeholder="Masukkan Stok" name="stok">
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Produk</label>
                        <input type="file" name="gambar" accept="image/*" class="form-control">
                    </div>
                </x-modal>
            </div>

            <!-- Filter dan Search -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <label class="me-2 mb-0">Tampil</label>
                    <select class="form-select form-select-sm w-auto">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>

                <div class="d-flex align-items-center">
                    <input type="search" class="form-control form-control-sm" placeholder="Search...">
                </div>
            </div>

            <!-- Grid Card Produk -->
            <div class="row g-4">
                @forelse ($barang as $b)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm hover-shadow transition rounded-3 overflow-hidden">
                            @if($b->gambar)
                                <img src="{{ asset('assets/img/storage/' . $b->gambar) }}" class="h-48 w-full object-cover"
                                    alt="{{ $b->nama_barang }}">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span class="text-muted small">Tidak ada gambar</span>
                                </div>
                            @endif

                            <div class="card-body p-3">
                                <h6 class="card-title fw-semibold text-dark mb-1">{{ $b->nama_barang }}</h6>
                                <p class="mb-1 text-muted small">Harga:
                                    <span class="fw-semibold text-success">Rp
                                        {{ number_format($b->harga_jual, 0, ',', '.') }}</span>
                                </p>
                                <p class="mb-0 text-muted small">Stok:
                                    <span class="fw-semibold">{{ $b->stok ?? 0 }}</span>
                                </p>
                                <br>
                                
                                <div class="d-flex justify-content-center gap-2 mt-2">
                                <x-modal modalId="editbarang{{ $b->idb }}" buttonText="Edit  Barang" title="Edit Barang" url="barang/update/{{ $b->idb }}"
                                    method="post" btnTutup="simpan perubahan">
                
                                    <div class="mb-3">
                                        <label class="form-label">Nama Kasir</label>
                                        <input type="text" id="nama_kasir" class="form-control" value="{{ auth()->user()->name }}"
                                            readonly>
                                    </div>
                
                                    <div class="mb-3">
                                        <label class="form-label">Nama Barang</label>
                                        <input type="text" class="form-control" placeholder="Masukkan nama barang" name="nama_barang" value="{{ $b->nama_barang }}">
                                    </div>
                
                                    <div class="mb-3">
                                        <label class="form-label">Harga Modal</label>
                                        <input type="number" class="form-control" placeholder="Masukkan Harga Modal" name="harga_modal" value="{{ $b->harga_modal }}">
                                    </div>
                
                                    <div class="mb-3">
                                        <label class="form-label">Harga Jual</label>
                                        <input type="number" class="form-control" placeholder="Masukkan Harga Jual" name="harga_jual" value="{{ $b->harga_jual }}">
                                    </div>
                
                                    <div class="mb-3">
                                        <label class="form-label">Stok</label>
                                        <input type="number" class="form-control" placeholder="Masukkan Stok" name="stok" value="{{ $b->stok }}">
                                    </div>
                
                                    <div class="mb-3">
                                        <label class="form-label">Gambar Produk</label><br>

                                        {{-- Tampilkan gambar lama jika ada --}}
                                        @if ($b->gambar)
                                            <img src="{{ asset('assets/img/storage/' . $b->gambar) }}" 
                                                alt="{{ $b->nama_barang }}" 
                                                width="100" class="mb-2 rounded">
                                        @endif

                                        <input type="file" name="gambar" class="form-control">
                                        {{-- Simpan nama file lama di input hidden --}}
                                        <input type="hidden" name="old_image" value="{{ $b->gambar }}">
                                    </div>
                                </x-modal>

                                <form action="{{ route('barang.destroy', $b->idb) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-md">Hapus</button>
                                </form>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        <p>Belum ada data barang.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection