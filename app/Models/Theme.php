<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Theme extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'name',
		'background',
		'background_thumb',
		'properties',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
		'properties' => 'array',
	];

	/**
	 * Get the user that owns the theme.
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public static function getPropertiesAliases(): array
	{
		return [
			'navbar_navitem_color' => [
				'slug' => '--navbar-navitem-color',
				'name' => 'Цвет текста элементов в меню',
				'value' => '',
			],
			'navbar_navitem_border_color' => [
				'slug' => '--navbar-navitem-border-color',
				'name' => 'Цвет обводки элементов в меню',
				'value' => '',
			],
			'navbar_contact_icon_color' => [
				'slug' => '--navbar-contact-icon-color',
				'name' => 'Цвет иконок контактов в меню',
				'value' => '',
			],
			'navbar_contact_color' => [
				'slug' => '--navbar-contact-color',
				'name' => 'Цвет контактов в меню',
				'value' => '',
			],

			'widget_border_color' => [
				'slug' => '--widget-border-color',
				'name' => 'Цвет обводки блока с виджетом',
				'value' => '',
			],
			'widget_title_color' => [
				'slug' => '--widget-title-color',
				'name' => 'Цвет заголовка в блоке с виджетом',
				'value' => '',
			],

			'articles_head_color' => [
				'slug' => '--articles-head-color',
				'name' => 'Цвет надписи "Новости"',
				'value' => '',
			],
			'article_title_color' => [
				'slug' => '--article-title-color',
				'name' => 'Цвет заголовка новости',
				'value' => '',
			],
			'article_hr_color' => [
				'slug' => '--article-hr-color',
				'name' => 'Цвет разделительной черты в новсти',
				'value' => '',
			],
			'article_bg_color' => [
				'slug' => '--article-bg-color',
				'name' => 'Фон новости',
				'value' => '',
			],
			'article_btn_bg_color' => [
				'slug' => '--article-btn-bg-color',
				'name' => 'Фон кнопки новости"',
				'value' => '',
			],
			'article_btn_color' => [
				'slug' => '--article-btn-color',
				'name' => 'Цвет текста в кнопке новости',
				'value' => '',
			],

			'special_offers_bg_color' => [
				'slug' => '--special-offers-bg-color',
				'name' => 'Цвет фона спец. предложений',
				'value' => '',
			],
			'special_offers_caption_color' => [
				'slug' => '--special-offers-caption-color',
				'name' => 'Цвет подписи спец. предложений',
				'value' => '',
			],
			'special_offers_btn_bg_color' => [
				'slug' => '--special-offers-btn-bg-color',
				'name' => 'Фон кнокпи спец. предложений',
				'value' => '',
			],
			'special_offers_btn_color' => [
				'slug' => '--special-offers-btn-color',
				'name' => 'Цвет текста в конпке спец. предложений',
				'value' => '',
			],

			'about_border_color' => [
				'slug' => '--about-border-color',
				'name' => 'Цвет обводки блока "О нас"',
				'value' => '',
			],
			'about_bg_color' => [
				'slug' => '--about-bg-color',
				'name' => 'Фон блока "О нас"',
				'value' => '',
			],
			'about_title_color' => [
				'slug' => '--about-title-color',
				'name' => 'Цвет заголовка "О нас"',
				'value' => '',
			],
			'about_shortdesc_color' => [
				'slug' => '--about-shortdesc-color',
				'name' => 'Цвет краткого описания "О нас"',
				'value' => '',
			],
			'about_btn_bg_color' => [
				'slug' => '--about-btn-bg-color',
				'name' => 'Фон кнопки в блоке "О нас"',
				'value' => '',
			],
			'about_btn_color' => [
				'slug' => '--about-btn-color',
				'name' => 'Цвет текста в кнопке в блоке "О нас"',
				'value' => '',
			],

			'images_border_color' => [
				'slug' => '--images-border-color',
				'name' => 'Цвет обводки изображения',
				'value' => '',
			],
			'images_chevron_color' => [
				'slug' => '--images-chevron-color',
				'name' => 'Цвет текста в кнокпи листания изображений',
				'value' => '',
			],
			'images_chevron_bg_color' => [
				'slug' => '--images-chevron-bg-color',
				'name' => 'Цвет фона кнокпи листания изображений',
				'value' => '',
			],

			'footer-bg-color' => [
				'slug' => '--footer-bg-color',
				'name' => 'Фон подвала',
				'value' => '',
			],
			'footer-title-color' => [
				'slug' => '--footer-title-color',
				'name' => 'Цвет заголовка в подвале',
				'value' => '',
			],
			'footer-triangle-color' => [
				'slug' => '--footer-triangle-color',
				'name' => 'Цвет триугольника в подвале',
				'value' => '',
			],
			'footer-contact-color' => [
				'slug' => '--footer-contact-color',
				'name' => 'Цвет контактов в подвале',
				'value' => '',
			],
			'footer-socialnetwork-bg-color' => [
				'slug' => '--footer-socialnetwork-bg-color',
				'name' => 'Фон соц. сетей в подвале',
				'value' => '',
			],
			'footer-socialnetwork-color' => [
				'slug' => '--footer-socialnetwork-color',
				'name' => 'Цвет текста в соц.сетях в подвале',
				'value' => '',
			],
			'footer-socialnetwork-hover-bg-color' => [
				'slug' => '--footer-socialnetwork-hover-bg-color',
				'name' => 'Фон соц. сетей в подвале при наведении',
				'value' => '',
			],
			'footer-socialnetwork-hover-color' => [
				'slug' => '--footer-socialnetwork-hover-color',
				'name' => 'Цвет текста в соц.сетях в подвале при наведении',
				'value' => '',
			],
		];
	}

	public static function getDefaultThemes()
	{
		return [
			'blueAir' => [
				'navbar_navitem_color' => '#fff',
				'navbar_navitem_border_color' => '#6aa2af',
				'navbar_contact_icon_color' => '#6aa2af',
				'navbar_contact_color' => '#fff',

				'widget_border_color' => '#77b0ff',
				'widget_title_color' => '#fff',

				'articles_head_color' => '#fff',
				'article_title_color' => '#f8f9fa',
				'article_hr_color' => '#fff',
				'article_bg_color' => '#77b0ff',
				'article_btn_bg_color' => '#ff9c00',
				'article_btn_color' => '#000',

				'special_offers_bg_color' => '#020410',
				'special_offers_caption_color' => '#fff',
				'special_offers_btn_bg_color' => '#ff9c00',
				'special_offers_btn_color' => '#fff',

				'about_border_color' => '#fff',
				'about_bg_color' => '#040410',
				'about_title_color' => '#5b95e9',
				'about_shortdesc_color' => '#fff',
				'about_btn_bg_color' => '#ff9c00',
				'about_btn_color' => '#000',

				'images_border_color' => '#78b1ff',
				'images_chevron_color' => '#000',
				'images_chevron_bg_color' => '#ffde41',

				'footer-bg-color' => '#0064b2',
				'footer-title-color' => '#fff',
				'footer-triangle-color' => '#fff',
				'footer-contact-color' => '#fff',
				'footer-socialnetwork-bg-color' => '#000',
				'footer-socialnetwork-color' => '#fff',
				'footer-socialnetwork-hover-bg-color' => '#ff9c00',
				'footer-socialnetwork-hover-color' => '#fff',
			],

			'blueSky' => [
				'navbar_navitem_color' => '#fff',
				'navbar_navitem_border_color' => '#6aa2af',
				'navbar_contact_icon_color' => '#6aa2af',
				'navbar_contact_color' => '#fff',

				'widget_border_color' => '#6aa2af',
				'widget_title_color' => '#fff',

				'articles_head_color' => '#fff',
				'article_title_color' => '#fff',
				'article_hr_color' => '#fff',
				'article_bg_color' => '#77b0ff',
				'article_btn_bg_color' => '#ff9c00',
				'article_btn_color' => '#000',

				'special_offers_bg_color' => '#040410',
				'special_offers_caption_color' => '#fff',
				'special_offers_btn_bg_color' => '#ff9c00',
				'special_offers_btn_color' => '#fff',

				'about_border_color' => '#fff',
				'about_bg_color' => '#040410',
				'about_title_color' => '#5b95e9',
				'about_shortdesc_color' => '#fff',
				'about_btn_bg_color' => '#ff9c00',
				'about_btn_color' => '#000',

				'images_border_color' => '#78b1ff',
				'images_chevron_color' => '#000',
				'images_chevron_bg_color' => '#ffde41',
			],

			'lightAir' => [
				'navbar_navitem_color' => '#fff',
				'navbar_navitem_border_color' => '#6aa2af',
				'navbar_contact_icon_color' => '#6aa2af',
				'navbar_contact_color' => '#fff',

				'widget_border_color' => '#6aa2af',
				'widget_title_color' => '#fff',

				'articles_head_color' => '#fff',
				'article_title_color' => '#fff',
				'article_hr_color' => '#fff',
				'article_bg_color' => '#77b0ff',
				'article_btn_bg_color' => '#ff9c00',
				'article_btn_color' => '#000',

				'special_offers_bg_color' => '#040410',
				'special_offers_caption_color' => '#fff',
				'special_offers_btn_bg_color' => '#ff9c00',
				'special_offers_btn_color' => '#fff',

				'about_border_color' => '#fff',
				'about_bg_color' => '#040410',
				'about_title_color' => '#5b95e9',
				'about_shortdesc_color' => '#fff',
				'about_btn_bg_color' => '#ff9c00',
				'about_btn_color' => '#000',

				'images_border_color' => '#78b1ff',
				'images_chevron_color' => '#000',
				'images_chevron_bg_color' => '#ffde41',
			],
		];
	}
}
