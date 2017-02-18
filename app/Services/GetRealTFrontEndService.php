<?php

namespace Timitek\GetRealT\Services;

use Quarx;
use Carbon\Carbon;
use Yab\Quarx\Repositories\BlogRepository;

class GetRealTFrontEndService {
    
    public function mainMenu() {
        $output = "";
        
        $mainMenu = Quarx::menu('main');
        if (!empty($mainMenu)) {
            $output = str_replace( '</a>', '</a></li>', str_replace( '<a ', '<li><a ', $mainMenu));
        }
        else {
            $output = "<li><a href='" . url('listings') . "'>Listings</a></li>" .
                      "<li><a href='" . url('blog') . "'>Blog</a></li>" .
                      "<li><a href='" . url('gallery') . "'>Gallery</a></li>" .
                      "<li><a href='" . url('faqs') . "'>FAQs</a></li>" .
                      "<li><a href='" . url('events') . "'>Events</a></li>";
        }
        
        return $output;
    }
    
    public function searchWidget() {
        ob_start();
        include(realpath(__DIR__.'/../../resources/views/widgets/searchWidget.php'));
        return ob_get_clean();
    }
    
    public function listingResultsWidget() {
        ob_start();
        include(realpath(__DIR__.'/../../resources/views/widgets/listingResultsWidget.php'));
        return ob_get_clean();
    }
    
    public function recentBlogPostsWidget($tag, $numPosts) {
        $output = "";
        $newRepo = new BlogRepository();
        $posts = $newRepo->findBlogsByTag($tag)->take($numPosts)->all();
        if (count($posts) > 0) {
            $output = "<ul>";
            foreach ($posts as $post) {
                $formattedDate = Carbon::parse($post->published_at)->format("F j, Y");
                $output .= "<li><a href='/blog/" . $post->url . "'>" . $post->title . "</a> <span>" . $formattedDate . "</span></li>";
            }
            $output .= "</ul>";
        }
        else {
            $output = "<div><h5>Blog posts tagged with <strong>[" . $tag . "]</strong>, will show up here.</h5></div>";
        }
        
        return $output;
    }

    public function parallaxHeaderWidget($title, $background) {
        
        extract([
                    'title' => $title,
                    'background' => (empty($background) ? "http://lorempixel.com/1400/900/abstract/" : $background),
                    'initialY' => (rand(0, 400) * -1)
                ]);
        ob_start();
        include(realpath(__DIR__.'/../../resources/views/widgets/parallaxHeaderWidget.php'));
        return ob_get_clean();
    }
    
}
