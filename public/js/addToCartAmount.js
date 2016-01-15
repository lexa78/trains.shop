$(function() {

    $('.addToCartAmount').bind("change keyup input click", function() {
            var value = $(this).val();
            if ((value < 0) || (value == 0)) {
                $(this).val(1);
            }
    });

});