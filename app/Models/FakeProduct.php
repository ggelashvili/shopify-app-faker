<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FakeProduct extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $fillable = ['shopify_id'];

    const UPDATED_AT = null;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
