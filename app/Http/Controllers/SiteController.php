<?php

namespace App\Http\Controllers;

use App\Mail\CallbackRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Services\SiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
	public SiteService $siteService;
	public string $domain;

	public function __construct(SiteService $siteService)
	{
		$this->siteService = $siteService;
		$this->domain = config('app.domain');
	}

	public function publish()
	{
		/**
		 * @var User $user
		 */
		$user = Auth::user();

		if (!$user->subdomain) {
			back()->with('message', __('messages.subdomain_isNull'))->with('status', 'error');
		}

		$html = $this->siteService->getPublishHtml($user);

		$folder = $user->subdomain . '.' . $this->domain;
		$pathToHtml = $folder . '/index.html';

		// $currentHtml = Storage::disk('agent-sites')->get($pathToHtml);

		if (!Storage::disk('agent-sites')->exists($folder)) {
			Storage::disk('agent-sites')->makeDirectory($folder);
		}

		Storage::disk('agent-sites')->put($pathToHtml, $html);

		return back()->with('message', __('messages.site_published'))->with('status', 'success');
	}

	public function preview()
	{
		/**
		 * @var User $user
		 */
		$user = Auth::user();

		if (!$user->subdomain) {
			back()->with('message', __('messages.subdomain_isNull'))->with('status', 'error');
		}

		$html = $this->siteService->getPublishHtml($user);

		return $html;
	}

	public function callbackForm(Request $request)
	{
		$data = $request->validate([
			'name' => ['string', 'required'],
			'phone' => ['string', 'required'],
			'subdomain' => ['string', 'required'],
		]);

		$agent = User::where('subdomain', $data['subdomain'])->firstOrFail();

		Mail::to($agent->email)->send(new CallbackRequest($data['name'], $data['phone'], $agent->email, sprintf("%s.%s", $agent->subdomain, $this->domain)));

		return response()->json([
			'status' => 'success',
		]);
	}
}
