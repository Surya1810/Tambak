<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Piutang extends Model
{
    use HasFactory;

    public function customer(): BelongsTo
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }
    public function akun(): BelongsTo
    {
        return $this->belongsTo(akun::class, 'akun_id');
    }

    protected $casts = [
        'tanggal' => 'datetime'
    ];
}
