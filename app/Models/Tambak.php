<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tambak extends Model
{
    use HasFactory, SoftDeletes;

    public function owner(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function kolam(): HasMany
    {
        return $this->hasMany(Kolam::class)->orderBy('name', 'asc');
    }
}
