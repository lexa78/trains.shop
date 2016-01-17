$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')
        }
    });

    $('.productCartAmount').bind("change keyup input click", function() {
            var value = $(this).val();
            var valWithId = $(this).attr('name');
            if (value > 0) {
                sendAjax(valWithId, value);
            } else {
                $(this).val(1);
                sendAjax(valWithId, 1);
            }
    });
});

function sendAjax(valWithId, value) {
    var totalSum = 0;
    $.ajax({
        url: 'productCartUpdate/' + valWithId + '/' + value,
        type: 'PUT',
        data: {id:valWithId, value:value},
        success: function (data) {
            if( ! data) {
                var price = $('#price_' + valWithId).html();
                var sum = price * value;
                $('#sum_' + valWithId).html(sum);
                $('td.sum').each(function (indx, element) {
                    totalSum += $(element).html() * 1;
                });
                $('p.totalSum b').html(totalSum);
            } else {
                $('input[name = '+valWithId+']').val(data);
                //var htmlFromParent = $('.parent'+valWithId).html();
                //htmlFromParent += '<p class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>';
                //alert();
            }
        }
    });
}