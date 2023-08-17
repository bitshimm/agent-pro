<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    public function socialNetworksUpdate(User $user, array $userSocialNetworks): void
    {
        foreach ($userSocialNetworks as $socialNetworkId => $socialNetworkLink) {
            if ($socialNetworkLink) {
                $userSocialNetworks[$socialNetworkId] = [
                    'link' => $socialNetworkLink,
                ];
            } else {
                unset($userSocialNetworks[$socialNetworkId]);
            }
        }

        $user->socialNetworks()->sync($userSocialNetworks);
    }

    public function widgetUpdate(User $user, array $data): void
    {
        $user->update($data);
    }

    public function contactsUpdate(User $user, array $data): void
    {
        if (array_key_exists('contact_phone', $data)) {
            $data['contact_phone'] = self::formatPhone($data['contact_phone']);
        }
        if (array_key_exists('contact_phone_second', $data)) {
            $data['contact_phone_second'] = self::formatPhone($data['contact_phone_second']);
        }

        $user->update($data);
    }

    public function aboutUpdate(User $user, array $data): void
    {
        $user->update($data);
    }

    public function logotypeUpdate(User $user, array $data): void
    {
        if ($data['logotype']) {
            if ($user->logotype !== null) {
                UploadService::unlink($user->logotype);
            }
            $user->logotype = UploadService::upload($data['logotype'], 'logotypes');
        }

        $user->update($data);
    }

    private static function formatPhone(string $phone): string
    {
        return str_replace(['(', ')', '-'], '', $phone);
    }
}
