<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'alamat',
        'no_hp',
    ];

    public function rekening()
    {
        return $this->hasMany(Rekening::class);
    }
}
