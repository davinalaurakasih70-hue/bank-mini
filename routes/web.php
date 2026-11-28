<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Models\Nasabah;
use App\Models\Rekening;
use App\Models\Transaksi;

Route::get('/', function () {
    $totalNasabah = Nasabah::count();
    $totalRekening = Rekening::where('status', 'aktif')->count();
    $totalSaldo = Rekening::sum('saldo');
    $transaksiHariIni = Transaksi::whereDate('created_at', today())->count();
    $transaksiTerbaru = Transaksi::with('rekening.nasabah')->latest()->take(5)->get();

    return view('dashboard', compact(
        'totalNasabah',
        'totalRekening',
        'totalSaldo',
        'transaksiHariIni',
        'transaksiTerbaru'
    ));
});

Route::resource('nasabah', NasabahController::class);

Route::get('rekening', [RekeningController::class, 'index'])->name('rekening.index');
Route::get('rekening/{rekening}', [RekeningController::class, 'show'])->name('rekening.show');

Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('transaksi/{transaksi}', [TransaksiController::class, 'show'])->name('transaksi.show');
Route::get('transaksi/{transaksi}/struk', [TransaksiController::class, 'cetakStruk'])->name('transaksi.struk');

Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
