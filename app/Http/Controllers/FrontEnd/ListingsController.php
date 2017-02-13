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
        $listing = GetRETS::getListing()->details($values[1], $values[0], $values[2]);
                
        if (empty($listing)) {
            abort(404);
        }
        
        return view('quarx-frontend::listings.show')->with('listing', $listing);
    }
}
