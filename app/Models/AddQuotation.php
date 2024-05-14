<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AddQuotation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function quotations(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    public function prescriptions(): BelongsTo
    {
        return $this->belongsTo(Prescription::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
