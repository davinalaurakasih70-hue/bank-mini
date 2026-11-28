<?php

namespace Tests\Feature;

use App\Models\Nasabah;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NasabahTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_nasabah_index(): void
    {
        $response = $this->get('/nasabah');
        $response->assertStatus(200);
        $response->assertSee('Data Nasabah');
    }

    public function test_can_create_nasabah(): void
    {
        $response = $this->post('/nasabah', [
            'nis' => '12345',
            'nama' => 'Budi Santoso',
            'kelas' => 'XII RPL 1',
            'alamat' => 'Jl. Merdeka No. 1',
            'no_hp' => '08123456789',
        ]);

        $response->assertRedirect('/nasabah');
        $this->assertDatabaseHas('nasabahs', [
            'nis' => '12345',
            'nama' => 'Budi Santoso',
        ]);
    }

    public function test_can_update_nasabah(): void
    {
        $nasabah = Nasabah::create([
            'nis' => '12345',
            'nama' => 'Budi Santoso',
            'kelas' => 'XII RPL 1',
            'alamat' => 'Jl. Merdeka No. 1',
            'no_hp' => '08123456789',
        ]);

        $response = $this->put('/nasabah/' . $nasabah->id, [
            'nis' => '12345',
            'nama' => 'Budi Santoso Updated',
            'kelas' => 'XII RPL 2',
            'alamat' => 'Jl. Sudirman',
            'no_hp' => '08987654321',
        ]);

        $response->assertRedirect('/nasabah');
        $this->assertDatabaseHas('nasabahs', [
            'id' => $nasabah->id,
            'nama' => 'Budi Santoso Updated',
        ]);
    }

    public function test_can_delete_nasabah(): void
    {
        $nasabah = Nasabah::create([
            'nis' => '12345',
            'nama' => 'Budi Santoso',
            'kelas' => 'XII RPL 1',
        ]);

        $response = $this->delete('/nasabah/' . $nasabah->id);

        $response->assertRedirect('/nasabah');
        $this->assertDatabaseMissing('nasabahs', [
            'id' => $nasabah->id,
        ]);
    }
}
