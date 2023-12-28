<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Harga extends Model
{
    use HasFactory;

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    protected $casts = [
        'mulai' => 'datetime:Y-m-d',
        'selesai' => 'datetime:Y-m-d'
    ];
}
