<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $fillable = [
        'rekening_id',
        'user_id',
        'kode_transaksi',
        'jenis',
        'jumlah',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'jumlah' => 'decimal:2',
        ];
    }

    public function rekening(): BelongsTo
    {
        return $this->belongsTo(Rekening::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
