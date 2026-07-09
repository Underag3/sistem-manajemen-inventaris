<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Laporan Data Barang</title>
<style>body{font-family:sans-serif;font-size:12px;color:#333}h1{text-align:center;color:#dc2626;font-size:18px;margin-bottom:5px}.subtitle{text-align:center;color:#666;font-size:11px;margin-bottom:20px}table{width:100%;border-collapse:collapse;margin-top:10px}th{background:#dc2626;color:white;padding:8px 6px;text-align:left;font-size:11px}td{padding:6px;border-bottom:1px solid #ddd;font-size:11px}tr:nth-child(even){background:#f9fafb}.footer{margin-top:20px;text-align:right;font-size:10px;color:#999}</style>
</head><body>
<h1>Laporan Data Barang</h1>
<p class="subtitle">Sistem Manajemen Inventaris - PT Telkomsel | Dicetak: {{ date('d/m/Y H:i') }}</p>
<table><thead><tr><th>No</th><th>Kode</th><th>Nama Barang</th><th>Kategori</th><th>Stok</th><th>Min</th><th>Lokasi</th><th>Kondisi</th></tr></thead>
<tbody>@foreach($products as $i => $p)<tr><td>{{ $i + 1 }}</td><td>{{ $p->code }}</td><td>{{ $p->name }}</td><td>{{ $p->category->name ?? '-' }}</td><td>{{ $p->stock }}</td><td>{{ $p->minimum_stock }}</td><td>{{ $p->storage_location }}</td><td>{{ $p->condition }}</td></tr>@endforeach</tbody></table>
<p class="footer">Total: {{ $products->count() }} barang</p>
</body></html>
