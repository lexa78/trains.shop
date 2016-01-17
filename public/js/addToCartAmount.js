$(function() {

    $('.addToCartAmount').bind("change keyup input click", function() {
            var value = $(this).val();
            if ((value < 0) || (value == 0)) {
                $(this).val(1);
            }
            var elementID = this.id;
            var currentAmount = $('.'+elementID).html() * 1;
            if(($(this).val() * 1) > currentAmount) {
                $(this).val(currentAmount);
            }
    });

});