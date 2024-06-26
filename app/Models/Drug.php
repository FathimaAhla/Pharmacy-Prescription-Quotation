<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Drug extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'description',
    ];

    public function quotation(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    public function prescriptions(): BelongsTo
    {
        return $this->belongsTo(Prescription::class);
    }
}
