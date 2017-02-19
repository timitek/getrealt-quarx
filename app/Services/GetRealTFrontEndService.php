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
            $output = str_replace('</a>', '</a></li>', str_replace('<a ', '<li><a ', $mainMenu));
        } else {
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
        include(realpath(__DIR__ . '/../../resources/views/widgets/searchWidget.php'));
        return ob_get_clean();
    }

    public function listingResultsWidget() {
        ob_start();
        include(realpath(__DIR__ . '/../../resources/views/widgets/listingResultsWidget.php'));
        return ob_get_clean();
    }

    public function recentBlogPostsWidget($tag, $numPosts) {
        $output = "";
        $posts = (new BlogRepository())->findBlogsByTag($tag)->take($numPosts)->all();
        if (count($posts) > 0) {
            $output = "<ul>";
            foreach ($posts as $post) {
                $formattedDate = Carbon::parse($post->published_at)->format("F j, Y");
                $output .= "<li><a href='/blog/" . $post->url . "'>" . $post->title . "</a> <span>" . $formattedDate . "</span></li>";
            }
            $output .= "</ul>";
        } else {
            $output = "<div><h5>Blog posts tagged with <strong>[" . $tag . "]</strong>, will show up here.</h5></div>";
        }

        return $output;
    }

    function ordinal($number) {
        $ordinal = $number;
        $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
        if ((($number % 100) >= 11) && (($number % 100) <= 13)) {
            $ordinal = $number . 'th';
        } else {
            $ordinal = $number . $ends[$number % 10];
        }
        return $ordinal;
    }

    public function blogPostByTagWidget($tag, $entry) {
        $output = "";
        $posts = (new BlogRepository())->findBlogsByTag($tag)->take($entry)->all();
        if (count($posts) >= $entry) {
            $post = $posts[$entry - 1];
            $output = "<div class='getrealt-bp'>" .
                    "<div class='getrealt-bp-title'>" . $post->title . "</div>" .
                    "<div class='getrealt-bp-entry'>" . $post->entry . "</div>" .
                    "</div>";
        } else {
            $output = "<div class='getrealt-bp'>" .
                    "<div class='getrealt-bp-title'>" . $tag . "</div>" .
                    "<div class='getrealt-bp-entry'><i class='fa fa-info-circle'></i>" .
                    "The <strong><em>" . $this->ordinal($entry) . "</em></strong> most recent blog post tagged with <strong>[" . $tag . "]</strong>, will show up here.<br /><br />" .
                    "If your post starts with an icon such as the ones found here <a href='http://fontawesome.io/icons/' target='_blank'>here</a>, they will be presented at the top of this content.<br />" .
                    "Example..<br /><pre><code>&lt;i class='fa fa-info-circle'&gt;&lt;/i&gt;</code></pre>" .
                    "</div>" .
                    "</div>";
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
        include(realpath(__DIR__ . '/../../resources/views/widgets/parallaxHeaderWidget.php'));
        return ob_get_clean();
    }

    public function testimonialsWidget() {
        $testimonials = (new BlogRepository())->findBlogsByTag('Testimonial')->all();

        if (count($testimonials) <= 0) {
            $testimonials = [(object) [
                    'title' => 'Blog Post Title Appears Here (example.. "My Happy Customer")',
                    'entry' => '<img src="https://randomuser.me/api/portraits/men/' . rand(1, 40) . '.jpg" alt=""><p>Blog posts tagged with <strong>[Testimonial]</strong>, will show up here. (example.. "I found my dream house! Thanks!")<br />If your post starts with an image, it will appear with the quote.</p>'
            ]];
        }

        extract([
            'testimonials' => $testimonials
        ]);
        ob_start();
        include(realpath(__DIR__ . '/../../resources/views/widgets/testimonialsWidget.php'));
        return ob_get_clean();
    }

}
