<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk - {{ $transaksi->kode_transaksi }}</title>
    <style>
        body { font-family: 'Courier New', monospace; font-size: 13px; background: #fff; margin: 0; padding: 10px; }
        .box { width: 320px; margin: auto; border: 1px dashed #000; padding: 15px; }
        .center { text-align: center; }
        .right { text-align: right; }
        .divider { border-top: 1px dashed #000; margin: 8px 0; }
        .bold { font-weight: bold; }
        .row { display: flex; justify-content: space-between; margin-bottom: 4px; }
        @media print { .no-print { display: none; } .box { border: none; } }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print center" style="margin-bottom:15px">
        <button onclick="window.print()" style="padding:8px 16px;cursor:pointer;font-weight:bold">Cetak Struk</button>
    </div>
    <div class="box">
        <div class="center">
            <h3 style="margin:0">BANK MINI SEKOLAH</h3>
            <p style="margin:2px 0;font-size:11px">Struk Transaksi Tabungan</p>
            <p style="margin:0;font-size:11px">{{ $transaksi->created_at->format('d/m/Y H:i') }}</p>
        </div>
        <div class="divider"></div>
        <div class="row"><span>No. TRX:</span><span class="bold">{{ $transaksi->kode_transaksi }}</span></div>
        <div class="row"><span>No. Rek:</span><span>{{ $transaksi->rekening->no_rekening }}</span></div>
        <div class="row"><span>Nasabah:</span><span class="bold">{{ $transaksi->rekening->nasabah->nama }}</span></div>
        <div class="row"><span>Kelas:</span><span>{{ $transaksi->rekening->nasabah->kelas }}</span></div>
        <div class="divider"></div>
        <div class="row"><span>JENIS:</span><span class="bold" style="text-transform:uppercase">{{ $transaksi->jenis }}</span></div>
        <div class="row"><span>NOMINAL:</span><span class="bold">Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</span></div>
        <div class="row"><span>Ket:</span><span>{{ $transaksi->keterangan ?? '-' }}</span></div>
        <div class="divider"></div>
        <div class="row bold"><span>SALDO AKHIR:</span><span>Rp {{ number_format($transaksi->rekening->saldo, 0, ',', '.') }}</span></div>
        <div class="divider"></div>
        <div class="center" style="font-size:10px;margin-top:10px">
            <p style="margin:2px 0">Terima Kasih Telah Menabung</p>
            <p style="margin:2px 0">Simpan struk ini sebagai bukti</p>
        </div>
    </div>
</body>
</html>
