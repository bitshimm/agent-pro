<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\SiteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class SiteController extends Controller
{
	public SiteService $siteService;

	public function __construct(SiteService $siteService)
	{
		$this->siteService = $siteService;
	}

	public function publish()
	{
		/**
		 * @var User $user
		 */
		$user = Auth::user();

		$this->siteService->publish($user);

		return back()->with('message', __('messages.site_published'))->with('status', 'success');
	}

	public function preview()
	{
		/**
		 * @var User $user
		 */
		$user = Auth::user();

		if (!$user->subdomain) {
			return back()->with('message', __('messages.subdomain_isNull'))->with('status', 'error');
		}

		$html = $this->siteService->getPublishHtml($user);

		return $html;
	}

	public function checkDifference(): JsonResponse
	{
		/**
		 * @var User $user
		 */
		$user = Auth::user();

		$previewEqualCurrent = $this->siteService->checkDifference($user);

		if ($previewEqualCurrent === true) {
			return response()->json([
				'different' => false,
			]);
		}

		return response()->json([
			'different' => true,
		]);
	}

	public function callbackForm(Request $request): JsonResponse
	{
		$data = $request->validate([
			'name' => ['string', 'required'],
			'phone' => ['string', 'required'],
			'subdomain' => ['string', 'required'],
		]);

		$this->siteService->callbackForm($data);

		return response()->json([
			'status' => 'success',
		]);
	}
}
