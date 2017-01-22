<?php

namespace Timitek\GetRealT\Http\Controllers;

use Illuminate\Http\Request;
use Timitek\GetRealT\Http\Controllers\GetRealTController;
use Yab\Quarx\Repositories\BlogRepository;

class ListingController extends GetRealTController
{
    /**
     * Display all Blog entries.
     *
     * @param int $id
     *
     * @return Response
     */
    public function all()
    {
        $blogRepo = new BlogRepository();
        
        $blogs = $blogRepo->publishedAndPaginated();
        $tags = $blogRepo->allTags();

        if (empty($blogs)) {
            abort(404);
        }

        return view('quarx-frontend::listings.all')
            ->with('tags', $tags)
            ->with('blogs', $blogs);
    }
    
}
