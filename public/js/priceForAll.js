$(function() {
    $('.priceForAll').bind("change keyup input click", function() {
        var attrName = $(this).attr('name');
        if (this.value.match(/[^0-9.]/g)) {
            this.value = this.value.replace(/[^0-9.]/g, '');
        } else {
            addValuesToAll(attrName, this.value);
        }
    });

});

function addValuesToAll(className, value) {
    $('.'+className).val(value);
}