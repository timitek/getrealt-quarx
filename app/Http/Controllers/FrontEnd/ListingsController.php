<?php

namespace Timitek\GetRealT\Http\Controllers\FrontEnd;

use GetRETS;
use App\Http\Controllers\Controller;

class ListingsController extends Controller
{

    /**
     * Display the default listings page.
     *
     * @param int $id
     *
     * @return Response
     */
    public function all()
    {
        return view('quarx-frontend::listings.all');
    }

    /**
     * Display the specified listing.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $values = explode("_", $id);
        $listingSource = $values[1];
        $listingType = $values[0];
        $listingId = $values[2];
        
        $listing = GetRETS::getListing()->details($listingSource, $listingType, $listingId);

        $headerImage = null;
        if ($listing->photoCount) {
            $randomPhoto = rand(0, $listing->photoCount - 1);
            $headerImage = GetRETS::getListing()->imageUrl($listingSource, $listingType, $listingId, $randomPhoto, 1400, 1400);
        }
                
        if (empty($listing)) {
            abort(404);
        }
        
        return view('quarx-frontend::listings.show', ['listing' => $listing, 'headerImage' => $headerImage]);
    }
}
