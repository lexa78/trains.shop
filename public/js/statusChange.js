$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')
        }
    });

    $('.statusChange').bind("change", function() {
        var statusId = $(this).val();
        var orderId = $('b.orderID').html();
        sendAjax(statusId, orderId);
    });
});

function sendAjax(statusId, orderId) {
    $.ajax({
        url: '/changeStatus/' + statusId + '/' + orderId,
        type: 'POST',
//        data: {id:valWithId, value:value},
        success: function (data) {
            if(data) {
                $('div.answerOnChange').html('<p class="alert alert-success">Статус заказа изменен <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>');
            } else {
                $('div.answerOnChange').html('<p class="alert alert-danger">Изменение статуса заказа прошло неудачно, статус НЕ изменен <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>');
            }
            //alert('Status changed');
            //if( ! (data * 1)) {
            //    var price = $('#price_' + valWithId).html();
            //    var sum = price * value;
            //    $('#sum_' + valWithId).html(sum);
            //    $('td.sum').each(function (indx, element) {
            //        totalSum += $(element).html() * 1;
            //    });
            //    $('p.totalSum b').html(totalSum);
            //} else {
            //    $('input[name = '+valWithId+']').val(data);
            //}
        }
    });
}