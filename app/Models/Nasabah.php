<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nasabah extends Model
{
    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'alamat',
        'no_hp',
    ];

    public function rekenings(): HasMany
    {
        return $this->hasMany(Rekening::class);
    }
}
