<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\SocialNetwork;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        // dd( $request->user()->socialNetworks);
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'social_networks' => SocialNetwork::orderBy('id')->get(),
            'user_social_networks' => $request->user()->socialNetworks,
            'widget' => $request->user()->widget,
            'about_title' => $request->user()->about_title,
            'about_short_description' => $request->user()->about_short_description,
            'about_full_description' => $request->user()->about_full_description,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    function sendmail()
    {
        Mail::raw('Hello World!', function ($msg) {
            $msg->to('b.shiman@flotconsult.ru')->subject('Test Email');
        });
        return 'success';
    }

    function socialNetworksUpdate(Request $request): RedirectResponse
    {
        $userSocialNetworks = $request->user_social_networks;

        foreach ($userSocialNetworks as $socialNetworkId => $socialNetworkLink) {
            $userSocialNetworks[$socialNetworkId] = [
                'link' => $socialNetworkLink,
            ];
        }

        $request->user()->socialNetworks()->sync($userSocialNetworks);

        return Redirect::route('profile.edit');
    }

    function widgetUpdate(Request $request): RedirectResponse {
        $request->validate([
            'widget' => ['string'],
        ]);

        $user = $request->user();

        $user->widget = $request->widget;

        $user->save();

        return Redirect::route('profile.edit');
    }

    function aboutUpdate(Request $request): RedirectResponse {
        // $request->validate([
        //     'about_title' => ['string'],
        //     'about_short_description' => ['string'],
        //     'about_full_description' => ['string'],
        // ]);

        $user = $request->user();

        $user->about_title = $request->about_title;
        $user->about_short_description = $request->about_short_description;
        $user->about_full_description = $request->about_full_description;

        $user->save();

        return Redirect::route('profile.edit');
    }
}
