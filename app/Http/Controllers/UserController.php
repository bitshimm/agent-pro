<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
	private UserService $userService;

	public function __construct(UserService $service)
	{
		$this->userService = $service;
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index(): Response
	{
		$users = User::get();

		return Inertia::render('User/Index', [
			'users' => $users,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): Response
	{
		return Inertia::render('User/Create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreRequest $storeRequest)
	{
		$data = $storeRequest->validated();

		$this->userService->store($data);

		return redirect()->route('users.index')->with('message', 'Пользователь создан')->with('status', 'success');
	}

	/**
	 * Display the specified resource.
	 */
	// public function show(string $id)
	// {
	// 	//
	// }

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(User $user)
	{
		return Inertia::render('User/Edit', [
			'user' => $user,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(string $id)
	{
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
	}
}
