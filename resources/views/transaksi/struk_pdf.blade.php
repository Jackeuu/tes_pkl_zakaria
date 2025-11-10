<h3 style="text-align: center;">TOKO KELONTONG</h3>
<p style="text-align: center;">Struk Transaksi #{{ $transaksi->id }}</p>
<hr>
<table width="100%" cellspacing="0" cellpadding="5" border="0">
    <tr>
        <th align="left">Barang</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Subtotal</th>
    </tr>
    @foreach ($transaksi->detailTransaksi as $item)
    <tr>
        <td>{{ $item->barang->nama_barang }}</td>
        <td align="center">{{ $item->qty }}</td>
        <td align="right">Rp {{ number_format($item->harga_jual) }}</td>
        <td align="right">Rp {{ number_format($item->subtotal) }}</td>
    </tr>
    @endforeach
</table>
<hr>
<p><strong>Total:</strong> Rp {{ number_format($transaksi->total_harga) }}</p>
<p><strong>Bayar:</strong> Rp {{ number_format($transaksi->bayar) }}</p>
<p><strong>Kembalian:</strong> Rp {{ number_format($transaksi->kembalian) }}</p>
<p style="text-align:center;">Terima Kasih Telah Berbelanja</p>
