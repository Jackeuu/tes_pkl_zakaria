@extends('master')
@section('konten')

    <h1>ini barang</h1>

    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Data Barang</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($barang as $item)
                <div class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-lg transition">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_barang }}"
                            class="h-48 w-full object-cover">
                    @else
                        <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                            Tidak ada gambar
                        </div>
                    @endif

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $item->nama_barang }}</h3>
                        <p class="text-gray-600">Harga: <span class="font-medium">Rp
                                {{ number_format($item->harga_jual, 0, ',', '.') }}</span></p>
                        <p class="text-gray-600">Stok: <span class="font-medium">{{ $item->stok ?? 0 }}</span></p>

                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('barang.edit', $item->id) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">Edit</a>
                            <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection