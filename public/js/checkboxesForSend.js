$(function() {
    var arr = [];
    var i = 0;
    $('.forSend').change(function(){
        if(this.checked){
            arr[i] = $(this).val();
            i++;
        }else{
            var val = $(this).val();
            var index = arr.indexOf(val);
            arr.splice(index, 1);
            i--;
        }
    });
    $('.btnSendChecked').click(function(){
        if(arr.length) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')
                }
            });
            sendAjax(JSON.stringify(arr));
        } else {
            alert('Пометьте хотя бы один документ на отправку');
        }
        //console.log(arr.length);
    });
});

function sendAjax(value) {
    $.ajax({
        url: '/admin/send_documents',
        type: 'POST',
        data: {value:value},
        success: function (data) {
//            location.reload();
            $('p.'+data).removeClass('hidden');
            setTimeout(function() {
                    location.reload() }, 2000
            );
        }
    });
}