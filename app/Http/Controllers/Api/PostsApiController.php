<?php

namespace Timitek\GetRealT\Http\Controllers\Api;

use GetRETS;
use Quarx;
use Yab\Quarx\Models\Blog;
use Illuminate\Http\Request;
use Yab\Quarx\Requests\BlogRequest;
use Yab\Quarx\Services\ValidationService;
use Yab\Quarx\Repositories\BlogRepository;
use Timitek\GetRealT\Http\Controllers\ApiController;

class PostsApiController extends ApiController {

    /**
     * Save Settings
     *
     * @param BlogRequest $request
     *
     * @return Response
     */
    public function store(Request $request) {
        
        $output = $this->verifyProvidedInput([
            'title' => 'A title is required',
            'entry' => 'Post content is required',
            'tags' => 'The tags are required',
        ]);

        if (empty($output)) {

                $details = [
                    'title' => $request['title'],
                    'entry' => $request['entry'],
                    'tags' => $request['tags'],
                    'is_published' => true,
                    'url' => strtolower(str_replace(' ', '-', preg_replace('/[^\w\s]/i', '', $request['title']))),
                    'template' => 'show',
                ];
    
                $blogRepository = new BlogRepository();
                $blog = $blogRepository->store($details);
    
                if ($blog) {
                    $output = $this->respondData($blog);
                }
                else {
                    $output = $this->respondUnprocessable('Blog could not be saved.');
                }
        }

        return $output;
    }
    
}
