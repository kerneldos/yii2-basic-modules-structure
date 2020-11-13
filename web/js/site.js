/**
 * Main Js file
 */

$(document).ready(function () {
    "use strict"

    $('#show_password').on('click', function () {
        var $input = $(this).closest('div').find('input');

        $(this).toggleClass('fa-eye-slash').toggleClass('fa-eye');

        if ( $input.attr('type') === 'password' ) {
            $input.attr('type', 'text');
        } else {
            $input.attr('type', 'password');
        }
    });

    $('.messages-container').infiniteScroll({
        path: '.next a',
        append: '.item',
        history: false,
        hideNav: '.pagination',
        status: '.scroller-status',
        prefill: true,
        // button: '.view-more-button',
        scrollThreshold: 100,
    });
});
