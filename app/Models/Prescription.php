<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prescription extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quotation(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    public function drugs(): HasMany
    {
        return $this->hasMany(Drug::class);
    }

    public function addQuotation(): HasMany
    {
        return $this->hasMany(AddQuotation::class);
    }

}
