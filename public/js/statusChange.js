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
        success: function (data) {
            if(data) {
                $('div.buttons_to_create').html('');
                $('div.answerOnChange').html('<p class="alert alert-success">Статус заказа изменен <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>');
                if(data == 5) {
                    $('div.buttons_to_create').html('<a href="http://trains.shop/purchases" class="btn btn-success">Создать Торг-12</a><a href="http://trains.shop/purchases" class="btn btn-success">Создать Счет-фактуру</a>');
                }
            } else {
                $('div.answerOnChange').html('<p class="alert alert-danger">Изменение статуса заказа прошло неудачно, статус НЕ изменен <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>');
            }
        }
    });
}