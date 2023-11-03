<?php

namespace App\Http\Controllers;

use App\Mail\CallbackShipped;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Services\SiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
	public SiteService $siteService;
	public string $domain = "cruisel.pro";

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

		if (!$user->subdomain) {
			back()->with('message', 'Не установлен поддомен')->with('status', 'error');
		}

		$html = $this->siteService->getPublishHtml($user);

		Storage::disk('agent-sites')->put($user->subdomain . '.' . $this->domain . '/index.html', $html);

		return $html;
		return back()->with('message', 'Сайт опубликован')->with('status', 'success');
	}

	public function callbackForm(Request $request)
	{
		$data = $request->validate([
			'name' => ['string', 'required'],
			'phone' => ['string', 'required'],
			'subdomain' => ['string', 'required'],
		]);

		$agent = User::where('subdomain', $data['subdomain'])->firstOrFail();

		Mail::to($agent->email)->send(new CallbackShipped($data['name'], $data['phone']));

		return response()->json([
			'status' => 'success',
		]);
	}
}
