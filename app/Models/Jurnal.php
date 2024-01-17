<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jurnal extends Model
{
    use HasFactory;

    public function akun(): BelongsTo
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }
    public function Owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    protected $casts = [
        'tanggal' => 'datetime'
    ];
}
