<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialOffer extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image',
        'image_thumb',
        'sort',
        'visibility'
    ];

    /**
     * Get the user that owns the special offer.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
