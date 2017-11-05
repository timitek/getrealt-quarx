<?php

namespace Timitek\GetRealT\Http\Controllers\FrontEnd;

use GetRETS;
use Yab\Quarx\Controllers\QuarxController;
use URL;
use Quarx;
use Yab\Quarx\Models\Blog;
use Illuminate\Http\Request;
use Yab\Quarx\Requests\BlogRequest;
use Yab\Quarx\Services\ValidationService;
use Yab\Quarx\Repositories\BlogRepository;

class PostsController extends QuarxController {

    protected $blogRepository;

    public function __construct(BlogRepository $blogRepo)
    {
        parent::construct();

        $this->blogRepository = $blogRepo;
    }

    /**
     * Store a newly created Blog in storage.
     *
     * @param BlogRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = ValidationService::check(Blog::$rules);

        if (!$validation['errors']) {
            $blog = $this->blogRepository->store($request->all());
            Quarx::notification('Blog saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$blog) {
            Quarx::notification('Blog could not be saved.', 'warning');
        }

        return redirect('/');
    }    
}
