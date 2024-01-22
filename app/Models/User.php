<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $role_id
 * @property int|null $theme_id
 * @property string $subdomain
 * @property string|null $logotype
 * @property string|null $contact_phone
 * @property string|null $contact_phone_second
 * @property string|null $contact_email
 * @property string|null $contact_address
 * @property string|null $contact_opening_hours
 * @property string|null $about_title
 * @property string|null $about_short_description
 * @property string|null $about_full_description
 * @property string|null $widget
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Article> $articles
 * @property-read int|null $articles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Image> $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Page> $pages
 * @property-read int|null $pages_count
 * @property-read \App\Models\Role $role
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialNetwork> $socialNetworks
 * @property-read int|null $social_networks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SpecialOffer> $specialOffers
 * @property-read int|null $special_offers_count
 * @property-read \App\Models\Theme|null $theme
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Theme> $themes
 * @property-read int|null $themes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAboutFullDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAboutShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAboutTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereContactAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereContactOpeningHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereContactPhoneSecond($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogotype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSubdomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereThemeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWidget($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'role_id',
		'theme_id',
		'subdomain',
		'logotype',
		'widget',
		'about_title',
		'about_short_description',
		'about_full_description',
		'contact_phone',
		'contact_phone_second',
		'contact_email',
		'contact_address',
		'contact_opening_hours',
		'meta_title',
		'meta_description',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function isAdmin()
	{
		if ($this->role->slug == 'admin') {
			return true;
		}
		return false;
	}

	public function isManager()
	{
		if ($this->role->slug == 'manager') {
			return true;
		}
		return false;
	}

	public function role(): BelongsTo
	{
		return $this->belongsTo(Role::class);
	}

	public function theme(): BelongsTo
	{
		return $this->belongsTo(Theme::class);
	}

	/**
	 * Get the articles for the user.
	 */
	public function articles(): HasMany
	{
		return $this->hasMany(Article::class);
	}

	/**
	 * Get the themes for the user.
	 */
	public function themes(): HasMany
	{
		return $this->hasMany(Theme::class);
	}

	/**
	 * Get the articles for the user.
	 */
	public function pages(): HasMany
	{
		return $this->hasMany(Page::class);
	}

	/**
	 * Get the special offers for the user.
	 */
	public function specialOffers(): HasMany
	{
		return $this->hasMany(SpecialOffer::class);
	}

	/**
	 * Get the images for the user.
	 */
	public function images(): HasMany
	{
		return $this->hasMany(Image::class);
	}

	/**
	 * Get the social_networks for the user.
	 */
	public function socialNetworks(): BelongsToMany
	{
		return $this->belongsToMany(SocialNetwork::class, 'user_social_network', 'user_id', 'social_network_id')->withPivot('link');
	}
}
