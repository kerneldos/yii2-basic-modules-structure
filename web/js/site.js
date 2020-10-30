$(document).ready(function () {
    $('#show_password').on('click', function () {
        var $input = $(this).closest('div').find('input');

        $(this).toggleClass('fa-eye-slash').toggleClass('fa-eye');

        if ( $input.attr('type') === 'password' ) {
            $input.attr('type', 'text');
        } else {
            $input.attr('type', 'password');
        }
    });
});
