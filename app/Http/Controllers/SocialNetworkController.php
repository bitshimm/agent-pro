<?php

namespace App\Http\Controllers;

use App\Http\Requests\SocialNetwork\StoreRequest;
use App\Http\Requests\SocialNetwork\UpdateRequest;
use App\Models\SocialNetwork;
use App\Services\SocialNetworkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SocialNetworkController extends Controller
{
    private SocialNetworkService $socialNetworkService;

    public function __construct(SocialNetworkService $service)
    {
        $this->socialNetworkService = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $social_networks = SocialNetwork::orderBy('id', 'desc')->get();

        return Inertia::render('SocialNetwork/Index', [
            'social_networks' => $social_networks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('SocialNetwork/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $storeRequest)
    {
        $data = $storeRequest->validated();

        $this->socialNetworkService->store($data);

        return redirect()->route('social-networks.index')->with('message', 'Социальная сеть добавлена')->with('status', 'success');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialNetwork $socialNetwork): Response
    {
        return Inertia::render('SocialNetwork/Edit', [
            'social_network' => $socialNetwork,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $updateRequest, SocialNetwork $socialNetwork): RedirectResponse
    {
        $data = $updateRequest->validated();

        $this->socialNetworkService->update($socialNetwork, $data);

        return redirect()->route('social-networks.edit', ['socialNetwork' => $socialNetwork->id])->with('message', 'Социальная сеть обновлена')->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialNetwork $socialNetwork)
    {
        $socialNetwork->delete();

        return redirect()->route('social-networks.index')->with('message', 'Социальная сеть удалена')->with('status', 'success');
    }
}
