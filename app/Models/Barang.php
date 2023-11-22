<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    use HasFactory;

    public function gudang(): BelongsTo
    {
        return $this->belongsTo(gudang::class, 'gudang_id');
    }
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(gudang::class, 'gudang_id');
    }
}
