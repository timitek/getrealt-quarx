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

    this.handleThemePreview = function () {
        $("select#Theme").change(function () {
            var theme = '/assets/img/theme_preview/' + $(this).val() + '.png';
            $("img#getRealTThemePreview").attr("src", theme);
        }).change()
    };

    this.start = function () {
        self.handleTagInit();
        self.handleThemePreview();
    };

};

document.addEventListener("DOMContentLoaded", function (event) {
    
    getrealtAdmin.start();
    
});
