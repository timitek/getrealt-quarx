<?php

namespace Timitek\GetRealT\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Yab\Quarx\Repositories\BlogRepository;

class ListingController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
