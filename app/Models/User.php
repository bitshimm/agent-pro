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

	public function role(): BelongsTo
	{
		return $this->belongsTo(Role::class);
	}

	public function theme(): BelongsTo
	{
		return $this->belongsTo(Theme::class);
	}

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
