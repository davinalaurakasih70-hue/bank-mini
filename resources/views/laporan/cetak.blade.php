<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi Bank Mini</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; padding: 20px; }
        .kop { text-align: center; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 20px; }
        .kop h2 { margin: 0; text-transform: uppercase; }
        .kop h4 { margin: 4px 0; }
        .kop p { margin: 0; font-size: 11px; color: #555; }
        table.data { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table.data th, table.data td { border: 1px solid #444; padding: 5px 8px; }
        table.data th { background: #f2f2f2; text-align: center; }
        .right { text-align: right; }
        .center { text-align: center; }
        .rekap { width: 320px; margin-left: auto; border: 1px solid #444; padding: 8px; margin-bottom: 30px; }
        .ttd { width: 100%; margin-top: 40px; }
        .ttd td { text-align: center; width: 50%; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print" style="text-align:right;margin-bottom:20px">
        <button onclick="window.print()" style="padding:8px 16px;cursor:pointer;font-weight:bold;background:#007bff;color:#fff;border:none;border-radius:4px">Cetak</button>
    </div>

    <div class="kop">
        <h2>BANK MINI SEKOLAH</h2>
        <h4>LAPORAN MUTASI KAS & TRANSAKSI TABUNGAN</h4>
        <p>Jl. Pendidikan No. 123, Kampus Sekolah</p>
    </div>

    <table style="margin-bottom:15px">
        <tr><td><strong>Periode</strong></td><td>: {{ date('d/m/Y', strtotime($tanggalMulai)) }} s/d {{ date('d/m/Y', strtotime($tanggalSelesai)) }}</td></tr>
        <tr><td><strong>Kategori</strong></td><td>: {{ ucfirst($jenis) }}</td></tr>
        <tr><td><strong>Dicetak</strong></td><td>: {{ date('d/m/Y H:i') }}</td></tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th>No</th><th>Tanggal</th><th>Kode Trx</th><th>No Rek</th><th>Nama</th><th>Kelas</th><th>Jenis</th><th>Nominal</th><th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $item)
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td class="center">{{ $item->created_at->format('d/m/Y') }}</td>
                    <td>{{ $item->kode_transaksi }}</td>
                    <td>{{ $item->rekening->no_rekening ?? '-' }}</td>
                    <td>{{ $item->rekening->nasabah->nama ?? '-' }}</td>
                    <td class="center">{{ $item->rekening->nasabah->kelas ?? '-' }}</td>
                    <td class="center">{{ strtoupper($item->jenis) }}</td>
                    <td class="right">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="9" class="center">Tidak ada data.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="rekap">
        <table width="100%">
            <tr><td>Total Setoran:</td><td class="right"><strong>Rp {{ number_format($totalSetoran, 0, ',', '.') }}</strong></td></tr>
            <tr><td>Total Penarikan:</td><td class="right"><strong>Rp {{ number_format($totalPenarikan, 0, ',', '.') }}</strong></td></tr>
            <tr style="border-top:1px solid #000"><td><strong>Saldo Bersih:</strong></td><td class="right"><strong>Rp {{ number_format($saldoBersih, 0, ',', '.') }}</strong></td></tr>
        </table>
    </div>

    <table class="ttd">
        <tr>
            <td>Mengetahui,<br><strong>Kepala Bank Mini</strong><br><br><br><br>( _________________ )</td>
            <td>{{ date('d F Y') }}<br><strong>Petugas Teller</strong><br><br><br><br>( _________________ )</td>
        </tr>
    </table>

</body>
</html>
