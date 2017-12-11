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

    private function insertIcon($entry, $icon) {
        $content = $entry;
        if (!empty($icon)) {
            $iconHtml = '<i class="fa ' . $icon . '"></i> ';
            // If the content starts with a paragraph put it at the beginning of the paragraph
            $pos = stripos($entry, '<p>');
            if ($pos === 0) {
                $content = substr_replace($entry, '<p>' . $iconHtml, $pos, strlen('<p>'));
            }
            else {
                $content = $iconHtml . $content;
            }
        }
        return $content;
    }

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
                'entry' => $this->insertIcon($request['entry'], $request['icon']),
                'tags' => $request['tags'],
                'is_published' => true,
                'url' => strtolower(str_replace(' ', '-', preg_replace('/[^\w\s]/i', '', $request['title']))),
                'template' => 'show',
            ];

            $blogRepository = new BlogRepository();
            $blog = null;
            if (empty($request['id'])) {
                $blog = $blogRepository->store($details);
            }
            else {
                $blog = $blogRepository->findBlogById($request['id']);
                $blog = $blogRepository->update($blog, $details);
            }

            if ($blog) {
                $output = $this->respondData($blog);
            }
            else {
                $output = $this->respondUnprocessable('Blog could not be saved.');
            }
        }

        return $output;
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id)
    {
        $output = null;
        $blogRepository = new BlogRepository();
        $blog = $blogRepository->findBlogById($id);

        if (empty($blog)) {
            $output = $this->respondUnprocessable('Blog could not be found.');
        }
        else {
            $output = $this->respondData($blog);
        }

        return $output;
    }    
}
