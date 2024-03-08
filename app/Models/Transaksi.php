<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use HasFactory;

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function awal(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'gudang_awal');
    }
    public function tujuan(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'gudang_tujuan');
    }
}
