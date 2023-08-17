<?php

namespace App\Services;

use App\Models\SpecialOffer;
use App\Models\User;
use App\Services\UploadService;
use Illuminate\Support\Facades\Auth;

class SpecialOfferService
{
    public function store($data)
    {
        if ($data['image']) {
            $file = $data['image'];
            $data['image'] = UploadService::upload($file, 'specialOfferImages');
            $data['image_thumb'] = UploadService::uploadThumb($file, 'specialOfferImages');
        }

        Auth::user()->specialOffers()->create($data);
    }

    public function update(SpecialOffer $specialOffer, $data)
    {
        if ($data['image']) {
            $file = $data['image'];

            $this->unlinkSpecialOfferImages($specialOffer);

            $data['image'] = UploadService::upload($file, 'specialOfferImages');
            $data['image_thumb'] = UploadService::uploadThumb($file, 'specialOfferImages');
        } else {
            unset($data['image']);
        }
        $specialOffer->update($data);
    }

    public function destroy(SpecialOffer $specialOffer)
    {
        $this->unlinkSpecialOfferImages($specialOffer);

        $specialOffer->delete();
    }

    private function unlinkSpecialOfferImages(SpecialOffer $specialOffer)
    {
        if ($specialOffer->image !== null) {
            UploadService::unlink($specialOffer->image);
        }
        if ($specialOffer->image_thumb !== null) {
            UploadService::unlink($specialOffer->image_thumb);
        }
    }
}
