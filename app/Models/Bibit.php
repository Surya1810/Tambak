<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bibit extends Model
{
    use HasFactory, SoftDeletes;

    public function kolam(): BelongsTo
    {
        return $this->belongsTo(Kolam::class, 'kolam_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function input_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}