<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $transaksi = Transaksi::with(['rekening.nasabah'])
            ->when($search, function ($query, $search) {
                $query->where('kode_transaksi', 'like', "%{$search}%")
                    ->orWhereHas('rekening', function ($q) use ($search) {
                        $q->where('no_rekening', 'like', "%{$search}%")
                            ->orWhereHas('nasabah', function ($n) use ($search) {
                                $n->where('nama', 'like', "%{$search}%");
                            });
                    });
            })
            ->latest()
            ->paginate(15);

        return view('transaksi.index', compact('transaksi', 'search'));
    }

    public function create()
    {
        $rekening = Rekening::with('nasabah')
            ->where('status', 'aktif')
            ->orderBy('no_rekening')
            ->get();

        return view('transaksi.create', compact('rekening'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rekening_id' => 'required|exists:rekenings,id',
            'jenis' => 'required|in:setoran,penarikan',
            'jumlah' => 'required|numeric|min:1000',
            'keterangan' => 'nullable|string|max:255',
        ]);

        return DB::transaction(function () use ($request) {
            $rekening = Rekening::lockForUpdate()->findOrFail($request->rekening_id);
            $jumlah = (float) $request->jumlah;

            if ($request->jenis === 'penarikan') {
                if ($rekening->saldo < $jumlah) {
                    return back()->withInput()->withErrors([
                        'jumlah' => 'Saldo tidak mencukupi! Saldo saat ini: Rp ' . number_format($rekening->saldo, 0, ',', '.'),
                    ]);
                }
                $rekening->saldo -= $jumlah;
            } else {
                $rekening->saldo += $jumlah;
            }

            $rekening->save();

            $tanggal = date('Ymd');
            $urutan = Transaksi::whereDate('created_at', today())->count() + 1;
            $kodeTransaksi = 'TRX-' . $tanggal . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);

            $transaksi = Transaksi::create([
                'rekening_id' => $rekening->id,
                'kode_transaksi' => $kodeTransaksi,
                'jenis' => $request->jenis,
                'jumlah' => $jumlah,
                'keterangan' => $request->keterangan ?: ($request->jenis === 'setoran' ? 'Setoran Tabungan' : 'Penarikan Tabungan'),
            ]);

            return redirect()->route('transaksi.show', $transaksi->id)
                ->with('success', 'Transaksi ' . ucfirst($request->jenis) . ' berhasil!');
        });
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['rekening.nasabah']);

        return view('transaksi.show', compact('transaksi'));
    }

    public function cetakStruk(Transaksi $transaksi)
    {
        $transaksi->load(['rekening.nasabah']);

        return view('transaksi.struk', compact('transaksi'));
    }
}
