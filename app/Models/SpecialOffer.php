<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\SpecialOffer
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property string|null $content
 * @property string|null $image
 * @property string|null $image_thumb
 * @property int $sort
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\SpecialOfferFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer whereImageThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialOffer withoutTrashed()
 * @mixin \Eloquent
 */
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
        'active'
    ];

    /**
     * Get the user that owns the special offer.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
