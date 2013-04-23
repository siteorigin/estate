jQuery(function($){

    $(window).resize(function(){
        // Initialize all the slides
        $('#home-page-slider .slides .slide').each(function(){
            var $$ = $(this);

            newCss = {};
            newCss.height = $$.find('.slide-contents').outerHeight();

            if($$.data('background-image') != null) {
                newCss['background-image'] = 'url(' + $$.data('background-image') + ')';
            }

            $$.css(newCss);
        });
    }).resize();
});