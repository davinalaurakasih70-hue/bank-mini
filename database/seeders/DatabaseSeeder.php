<?php

namespace Database\Seeders;

use App\Models\Nasabah;
use App\Models\Rekening;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = [
            ['nis' => '1021001', 'nama' => 'Ahmad Fauzi', 'kelas' => 'XII RPL 1', 'alamat' => 'Jl. Merdeka No. 1', 'no_hp' => '081234567890'],
            ['nis' => '1021002', 'nama' => 'Siti Nurhaliza', 'kelas' => 'XII AKL 1', 'alamat' => 'Jl. Mawar No. 4', 'no_hp' => '081234567891'],
            ['nis' => '1021003', 'nama' => 'Budi Santoso', 'kelas' => 'XI RPL 2', 'alamat' => 'Jl. Melati No. 7', 'no_hp' => '081234567892'],
        ];

        foreach ($siswa as $i => $data) {
            $nasabah = Nasabah::create($data);

            $rekening = Rekening::create([
                'nasabah_id' => $nasabah->id,
                'no_rekening' => '100' . str_pad($nasabah->id, 5, '0', STR_PAD_LEFT),
                'saldo' => 100000,
                'status' => 'aktif',
            ]);

            Transaksi::create([
                'rekening_id' => $rekening->id,
                'kode_transaksi' => 'TRX-' . date('Ymd') . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'jenis' => 'setoran',
                'jumlah' => 100000,
                'keterangan' => 'Setoran Awal Buka Rekening',
            ]);
        }
    }
}
