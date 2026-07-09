<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Laporan Peminjaman</title>
<style>body{font-family:sans-serif;font-size:12px;color:#333}h1{text-align:center;color:#dc2626;font-size:18px;margin-bottom:5px}.subtitle{text-align:center;color:#666;font-size:11px;margin-bottom:20px}table{width:100%;border-collapse:collapse;margin-top:10px}th{background:#dc2626;color:white;padding:8px 6px;text-align:left;font-size:11px}td{padding:6px;border-bottom:1px solid #ddd;font-size:11px}tr:nth-child(even){background:#f9fafb}.footer{margin-top:20px;text-align:right;font-size:10px;color:#999}.status-borrowed{color:#b45309}.status-returned{color:#15803d}</style>
</head><body>
<h1>Laporan Peminjaman Barang</h1>
<p class="subtitle">Sistem Manajemen Inventaris - PT Telkomsel | Dicetak: {{ date('d/m/Y H:i') }}</p>
<table><thead><tr><th>No</th><th>Peminjam</th><th>Barang</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th><th>Oleh</th></tr></thead>
<tbody>@foreach($borrowings as $i => $b)<tr><td>{{ $i + 1 }}</td><td>{{ $b->borrower_name }}</td><td>{{ $b->details->map(fn($d) => $d->product->name . ' (x'.$d->quantity.')')->implode(', ') }}</td><td>{{ $b->borrow_date->format('d/m/Y') }}</td><td>{{ $b->return_date?->format('d/m/Y') ?? '-' }}</td><td class="status-{{ $b->status }}">{{ ucfirst($b->status) }}</td><td>{{ $b->creator->name ?? '-' }}</td></tr>@endforeach</tbody></table>
<p class="footer">Total: {{ $borrowings->count() }} transaksi</p>
</body></html>
