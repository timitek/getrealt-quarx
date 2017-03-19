if (!RedactorPlugins) 
    var RedactorPlugins = {};

RedactorPlugins.insertIcon = function ()
{
    return {
        getTemplate: function (icons)
        {
            var iconList = '';
            for (var i = 0; i < icons.length; i++) {
                iconList += '<button type="button" class="btn btn-default btn-icon" data-toggle="tooltip" data-placement="top" title="' + icons[i] + '"><i class="fa fa-' + icons[i] + '" id="insert-icon-' + icons[i] + '"></i></button>';
            }

            return String()
                    + '<section id="redactor-modal-fonts">'
                    + '<div class="row"><div class="col-xs-12"><div class="input-group"><input id="fontSearch" class="form-control" placeholder="search"><span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span></div></div></div>'
                    + '<div class="row"><div class="col-xs-12"><h1><i id="iconSelected" class="fa fa-smile-o"></i></h1></div></div>'
                    + '<div class="row icon-list"><div class="col-xs-12">'
                    + iconList
                    + '</div></div>'
                    + '</section>';
        },
        init: function ()
        {
            var button = this.button.add('insertIcon', 'Insert Icon');

            this.button.setAwesome('insertIcon', 'fa-smile-o');
            this.button.addCallback(button, this.insertIcon.show);
        },
        show: function ()
        {
            var icons = ['glass', 'music', 'search', 'envelope-o', 'heart', 'star', 'star-o', 'user', 'film', 'th-large', 'th', 'th-list', 'check', 'times', 'search-plus', 'search-minus', 'power-off', 'signal', 'cog', 'trash-o', 'home', 'file-o', 'clock-o', 'road', 'download', 'arrow-circle-o-down', 'arrow-circle-o-up', 'inbox', 'play-circle-o', 'repeat', 'refresh', 'list-alt', 'lock', 'flag', 'headphones', 'volume-off', 'volume-down', 'volume-up', 'qrcode', 'barcode', 'tag', 'tags', 'book', 'bookmark', 'print', 'camera', 'font', 'bold', 'italic', 'text-height', 'text-width', 'align-left', 'align-center', 'align-right', 'align-justify', 'list', 'outdent', 'indent', 'video-camera', 'picture-o', 'pencil', 'map-marker', 'adjust', 'tint', 'pencil-square-o', 'share-square-o', 'check-square-o', 'arrows', 'step-backward', 'fast-backward', 'backward', 'play', 'pause', 'stop', 'forward', 'fast-forward', 'step-forward', 'eject', 'chevron-left', 'chevron-right', 'plus-circle', 'minus-circle', 'times-circle', 'check-circle', 'question-circle', 'info-circle', 'crosshairs', 'times-circle-o', 'check-circle-o', 'ban', 'arrow-left', 'arrow-right', 'arrow-up', 'arrow-down', 'share', 'expand', 'compress', 'plus', 'minus', 'asterisk', 'exclamation-circle', 'gift', 'leaf', 'fire', 'eye', 'eye-slash', 'exclamation-triangle', 'plane', 'calendar', 'random', 'comment', 'magnet', 'chevron-up', 'chevron-down', 'retweet', 'shopping-cart', 'folder', 'folder-open', 'arrows-v', 'arrows-h', 'bar-chart', 'twitter-square', 'facebook-square', 'camera-retro', 'key', 'cogs', 'comments', 'thumbs-o-up', 'thumbs-o-down', 'star-half', 'heart-o', 'sign-out', 'linkedin-square', 'thumb-tack', 'external-link', 'sign-in', 'trophy', 'github-square', 'upload', 'lemon-o', 'phone', 'square-o', 'bookmark-o', 'phone-square', 'twitter', 'facebook', 'github', 'unlock', 'credit-card', 'rss', 'hdd-o', 'bullhorn', 'bell', 'certificate', 'hand-o-right', 'hand-o-left', 'hand-o-up', 'hand-o-down', 'arrow-circle-left', 'arrow-circle-right', 'arrow-circle-up', 'arrow-circle-down', 'globe', 'wrench', 'tasks', 'filter', 'briefcase', 'arrows-alt', 'users', 'link', 'cloud', 'flask', 'scissors', 'files-o', 'paperclip', 'floppy-o', 'square', 'bars', 'list-ul', 'list-ol', 'strikethrough', 'underline', 'table', 'magic', 'truck', 'pinterest', 'pinterest-square', 'google-plus-square', 'google-plus', 'money', 'caret-down', 'caret-up', 'caret-left', 'caret-right', 'columns', 'sort', 'sort-desc', 'sort-asc', 'envelope', 'linkedin', 'undo', 'gavel', 'tachometer', 'comment-o', 'comments-o', 'bolt', 'sitemap', 'umbrella', 'clipboard', 'lightbulb-o', 'exchange', 'cloud-download', 'cloud-upload', 'user-md', 'stethoscope', 'suitcase', 'bell-o', 'coffee', 'cutlery', 'file-text-o', 'building-o', 'hospital-o', 'ambulance', 'medkit', 'fighter-jet', 'beer', 'h-square', 'plus-square', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-double-down', 'angle-left', 'angle-right', 'angle-up', 'angle-down', 'desktop', 'laptop', 'tablet', 'mobile', 'circle-o', 'quote-left', 'quote-right', 'spinner', 'circle', 'reply', 'github-alt', 'folder-o', 'folder-open-o', 'smile-o', 'frown-o', 'meh-o', 'gamepad', 'keyboard-o', 'flag-o', 'flag-checkered', 'terminal', 'code', 'reply-all', 'star-half-o', 'location-arrow', 'crop', 'code-fork', 'chain-broken', 'question', 'info', 'exclamation', 'superscript', 'subscript', 'eraser', 'puzzle-piece', 'microphone', 'microphone-slash', 'shield', 'calendar-o', 'fire-extinguisher', 'rocket', 'maxcdn', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-circle-down', 'html5', 'css3', 'anchor', 'unlock-alt', 'bullseye', 'ellipsis-h', 'ellipsis-v', 'rss-square', 'play-circle', 'ticket', 'minus-square', 'minus-square-o', 'level-up', 'level-down', 'check-square', 'pencil-square', 'external-link-square', 'share-square', 'compass', 'caret-square-o-down', 'caret-square-o-up', 'caret-square-o-right', 'eur', 'gbp', 'usd', 'inr', 'jpy', 'rub', 'krw', 'btc', 'file', 'file-text', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-numeric-asc', 'sort-numeric-desc', 'thumbs-up', 'thumbs-down', 'youtube-square', 'youtube', 'xing', 'xing-square', 'youtube-play', 'dropbox', 'stack-overflow', 'instagram', 'flickr', 'adn', 'bitbucket', 'bitbucket-square', 'tumblr', 'tumblr-square', 'long-arrow-down', 'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple', 'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare', 'trello', 'female', 'male', 'gratipay', 'sun-o', 'moon-o', 'archive', 'bug', 'vk', 'weibo', 'renren', 'pagelines', 'stack-exchange', 'arrow-circle-o-right', 'arrow-circle-o-left', 'caret-square-o-left', 'dot-circle-o', 'wheelchair', 'vimeo-square', 'try', 'plus-square-o', 'space-shuttle', 'slack', 'envelope-square', 'wordpress', 'openid', 'university', 'graduation-cap', 'yahoo', 'google', 'reddit', 'reddit-square', 'stumbleupon-circle', 'stumbleupon', 'delicious', 'digg', 'pied-piper-pp', 'pied-piper-alt', 'drupal', 'joomla', 'language', 'fax', 'building', 'child', 'paw', 'spoon', 'cube', 'cubes', 'behance', 'behance-square', 'steam', 'steam-square', 'recycle', 'car', 'taxi', 'tree', 'spotify', 'deviantart', 'soundcloud', 'database', 'file-pdf-o', 'file-word-o', 'file-excel-o', 'file-powerpoint-o', 'file-image-o', 'file-archive-o', 'file-audio-o', 'file-video-o', 'file-code-o', 'vine', 'codepen', 'jsfiddle', 'life-ring', 'circle-o-notch', 'rebel', 'empire', 'git-square', 'git', 'hacker-news', 'tencent-weibo', 'qq', 'weixin', 'paper-plane', 'paper-plane-o', 'history', 'circle-thin', 'header', 'paragraph', 'sliders', 'share-alt', 'share-alt-square', 'bomb', 'futbol-o', 'tty', 'binoculars', 'plug', 'slideshare', 'twitch', 'yelp', 'newspaper-o', 'wifi', 'calculator', 'paypal', 'google-wallet', 'cc-visa', 'cc-mastercard', 'cc-discover', 'cc-amex', 'cc-paypal', 'cc-stripe', 'bell-slash', 'bell-slash-o', 'trash', 'copyright', 'at', 'eyedropper', 'paint-brush', 'birthday-cake', 'area-chart', 'pie-chart', 'line-chart', 'lastfm', 'lastfm-square', 'toggle-off', 'toggle-on', 'bicycle', 'bus', 'ioxhost', 'angellist', 'cc', 'ils', 'meanpath', 'buysellads', 'connectdevelop', 'dashcube', 'forumbee', 'leanpub', 'sellsy', 'shirtsinbulk', 'simplybuilt', 'skyatlas', 'cart-plus', 'cart-arrow-down', 'diamond', 'ship', 'user-secret', 'motorcycle', 'street-view', 'heartbeat', 'venus', 'mars', 'mercury', 'transgender', 'transgender-alt', 'venus-double', 'mars-double', 'venus-mars', 'mars-stroke', 'mars-stroke-v', 'mars-stroke-h', 'neuter', 'genderless', 'facebook-official', 'pinterest-p', 'whatsapp', 'server', 'user-plus', 'user-times', 'bed', 'viacoin', 'train', 'subway', 'medium', 'y-combinator', 'optin-monster', 'opencart', 'expeditedssl', 'battery-full', 'battery-three-quarters', 'battery-half', 'battery-quarter', 'battery-empty', 'mouse-pointer', 'i-cursor', 'object-group', 'object-ungroup', 'sticky-note', 'sticky-note-o', 'cc-jcb', 'cc-diners-club', 'clone', 'balance-scale', 'hourglass-o', 'hourglass-start', 'hourglass-half', 'hourglass-end', 'hourglass', 'hand-rock-o', 'hand-paper-o', 'hand-scissors-o', 'hand-lizard-o', 'hand-spock-o', 'hand-pointer-o', 'hand-peace-o', 'trademark', 'registered', 'creative-commons', 'gg', 'gg-circle', 'tripadvisor', 'odnoklassniki', 'odnoklassniki-square', 'get-pocket', 'wikipedia-w', 'safari', 'chrome', 'firefox', 'opera', 'internet-explorer', 'television', 'contao', '500px', 'amazon', 'calendar-plus-o', 'calendar-minus-o', 'calendar-times-o', 'calendar-check-o', 'industry', 'map-pin', 'map-signs', 'map-o', 'map', 'commenting', 'commenting-o', 'houzz', 'vimeo', 'black-tie', 'fonticons', 'reddit-alien', 'edge', 'credit-card-alt', 'codiepie', 'modx', 'fort-awesome', 'usb', 'product-hunt', 'mixcloud', 'scribd', 'pause-circle', 'pause-circle-o', 'stop-circle', 'stop-circle-o', 'shopping-bag', 'shopping-basket', 'hashtag', 'bluetooth', 'bluetooth-b', 'percent', 'gitlab', 'wpbeginner', 'wpforms', 'envira', 'universal-access', 'wheelchair-alt', 'question-circle-o', 'blind', 'audio-description', 'volume-control-phone', 'braille', 'assistive-listening-systems', 'american-sign-language-interpreting', 'deaf', 'glide', 'glide-g', 'sign-language', 'low-vision', 'viadeo', 'viadeo-square', 'snapchat', 'snapchat-ghost', 'snapchat-square', 'pied-piper', 'first-order', 'yoast', 'themeisle', 'google-plus-official', 'font-awesome', 'handshake-o', 'envelope-open', 'envelope-open-o', 'linode', 'address-book', 'address-book-o', 'address-card', 'address-card-o', 'user-circle', 'user-circle-o', 'user-o', 'id-badge', 'id-card', 'id-card-o', 'quora', 'free-code-camp', 'telegram', 'thermometer-full', 'thermometer-three-quarters', 'thermometer-half', 'thermometer-quarter', 'thermometer-empty', 'shower', 'bath', 'podcast', 'window-maximize', 'window-minimize', 'window-restore', 'window-close', 'window-close-o', 'bandcamp', 'grav', 'etsy', 'imdb', 'ravelry', 'eercast', 'microchip', 'snowflake-o', 'superpowers', 'wpexplorer', 'meetup'];

            this.modal.addTemplate('insertIcon', this.insertIcon.getTemplate(icons));
            this.modal.load('insertIcon', 'Icons', 800);
            this.modal.createCancelButton();

            var savebutton = this.modal.createActionButton('Insert');
            savebutton.on('click', this.insertIcon.insert);

            this.selection.save();
            this.modal.show();

            $('#fontSearch').keyup(function () {
                var valThis = $(this).val().toLowerCase();
                $('.btn-icon').each(function () {
                    var title = $(this)[0].title.toLowerCase();
                    (title.indexOf(valThis) === 0) ? $(this).show() : $(this).hide();
                });
            });

            $(".btn-icon").click(function () {
                var newCls = 'fa-' + $(this)[0].title;
                $('#iconSelected').removeClass();
                $('#iconSelected').addClass('fa');
                $('#iconSelected').addClass(newCls);
            });

            $('#iconSelected');
        },
        insert: function (e)
        {
            var classList = $("#iconSelected")[0].classList;

            this.modal.close();
            this.selection.restore();

            var node = $('<i />');
            for (var i = 0; i < classList.length; i++) {
                node.addClass(classList[i]);
            }
            this.insert.node(node);
            this.insert.node($('<span />').html('&nbsp;', false));

            this.code.sync();
        }
    };
};


var getrealtAdmin = new function () {

    var self = this;

    this.getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };
    
    this.handleTagInit = function () {
        var tagInit = self.getUrlParameter('taginit');
        if (tagInit) {
            $('.tags#Tags').tagsinput();
            $('.tags#Tags').tagsinput('add', tagInit);
        }
    };

    this.start = function () {
        _redactorConfig.plugins.push('insertIcon');
        _redactorConfig.buttons.push('insertIcon');
        
        self.handleTagInit();
    };

};

document.addEventListener("DOMContentLoaded", function (event) {
    
    getrealtAdmin.start();
    
});
