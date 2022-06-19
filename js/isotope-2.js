jQuery(function ($) {

    var $grid = $('.grid').isotope({
        // options
        itemSelector: '.grid-item',
        layoutMode: 'masonry',
        masonry : {
            columnWidth: 400,
            fitWidth: true
        }

    });
    //Click event for category buttons
    //Get the attribute value for data-filter and filter based on the value. 
    $('.filter-button-group').on('click', 'button', function () {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({
            filter: filterValue
        });
    });

});

//Lightbox options for displaying on front-end

lightbox.option({
    'resizeDuration': 400,
    'wrapAround': true,
    'fitImagesInViewport': true,
    'disableScrolling': true,
    'fadeDuration': 400,
    'maxWidth': 700,
    'maxHeight' : 700,
})
