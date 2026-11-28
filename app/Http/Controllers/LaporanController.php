<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalMulai = $request->query('tanggal_mulai', date('Y-m-01'));
        $tanggalSelesai = $request->query('tanggal_selesai', date('Y-m-d'));
        $jenis = $request->query('jenis', 'semua');

        $query = Transaksi::with(['rekening.nasabah'])
            ->whereDate('created_at', '>=', $tanggalMulai)
            ->whereDate('created_at', '<=', $tanggalSelesai);

        if ($jenis !== 'semua' && in_array($jenis, ['setoran', 'penarikan'])) {
            $query->where('jenis', $jenis);
        }

        $transaksi = $query->orderBy('created_at', 'desc')->get();

        $totalSetoran = $transaksi->where('jenis', 'setoran')->sum('jumlah');
        $totalPenarikan = $transaksi->where('jenis', 'penarikan')->sum('jumlah');
        $saldoBersih = $totalSetoran - $totalPenarikan;
        $totalTransaksi = $transaksi->count();

        return view('laporan.index', compact(
            'transaksi',
            'tanggalMulai',
            'tanggalSelesai',
            'jenis',
            'totalSetoran',
            'totalPenarikan',
            'saldoBersih',
            'totalTransaksi'
        ));
    }

    public function cetak(Request $request)
    {
        $tanggalMulai = $request->query('tanggal_mulai', date('Y-m-01'));
        $tanggalSelesai = $request->query('tanggal_selesai', date('Y-m-d'));
        $jenis = $request->query('jenis', 'semua');

        $query = Transaksi::with(['rekening.nasabah'])
            ->whereDate('created_at', '>=', $tanggalMulai)
            ->whereDate('created_at', '<=', $tanggalSelesai);

        if ($jenis !== 'semua' && in_array($jenis, ['setoran', 'penarikan'])) {
            $query->where('jenis', $jenis);
        }

        $transaksi = $query->orderBy('created_at', 'asc')->get();

        $totalSetoran = $transaksi->where('jenis', 'setoran')->sum('jumlah');
        $totalPenarikan = $transaksi->where('jenis', 'penarikan')->sum('jumlah');
        $saldoBersih = $totalSetoran - $totalPenarikan;

        return view('laporan.cetak', compact(
            'transaksi',
            'tanggalMulai',
            'tanggalSelesai',
            'jenis',
            'totalSetoran',
            'totalPenarikan',
            'saldoBersih'
        ));
    }
}
