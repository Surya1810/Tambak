<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(supplier::class, 'supplier_id');
    }
    public function barang(): BelongsTo
    {
        return $this->belongsTo(barang::class, 'barang_id');
    }
}
