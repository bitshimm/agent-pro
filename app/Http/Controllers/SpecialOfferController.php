<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialOffer\StoreRequest;
use App\Http\Requests\SpecialOffer\UpdateRequest;
use App\Models\SpecialOffer;
use App\Services\SpecialOfferService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;

class SpecialOfferController extends Controller
{

	private SpecialOfferService $specialOfferService;

	public function __construct(SpecialOfferService $service)
	{
		$this->specialOfferService = $service;
	}

	public function index(): Response
	{
		/**
		 * @var User $user
		 */
		$user = Auth::user();

		$specialOffers = $user->specialOffers()->orderBy('id', 'desc')->paginate(7);

		return Inertia::render('SpecialOffer/Index', [
			'special_offers' => $specialOffers,
		]);
	}

	public function create(): Response
	{
		return Inertia::render('SpecialOffer/Create');
	}

	public function store(StoreRequest $storeRequest): RedirectResponse
	{
		$data = $storeRequest->validated();

		/**
		 * @var User $user
		 */
		$user = Auth::user();

		$this->specialOfferService->store($user, $data);

		return redirect()->route('special-offers.index')->with('message', __('messages.special_offer_created'))->with('status', 'success');
	}

	public function edit(SpecialOffer $specialOffer): Response
	{
		return Inertia::render('SpecialOffer/Edit', [
			'special_offer' => $specialOffer,
		]);
	}

	public function update(UpdateRequest $updateRequest, SpecialOffer $specialOffer): RedirectResponse
	{
		$data = $updateRequest->validated();

		$this->specialOfferService->update($specialOffer, $data);

		return redirect()->route('special-offers.edit', ['specialOffer' => $specialOffer->id])->with('message', __('messages.special_offer_updated'))->with('status', 'success');
	}

	public function destroy(SpecialOffer $specialOffer): RedirectResponse
	{
		$this->specialOfferService->destroy($specialOffer);

		return redirect()->route('special-offers.index')->with('message', __('messages.special_offer_deleted'))->with('status', 'success');
	}
}
