<?php

namespace App\Services;

use App\Models\SocialNetwork;
use Illuminate\Support\Facades\Auth;

class SocialNetworkService
{
    public function store($data)
    {
        SocialNetwork::create($data);
    }

    public function update($socialNetwork, $data)
    {
        $socialNetwork->update($data);
    }
}
