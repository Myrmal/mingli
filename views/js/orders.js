$(document).ready(function(){
    var body = $('body');
    body.on('click','#addOrder',function(){
        if( !$('#new_name').val() || !$('#new_email').val() || !$('#new_phone').val())
        {
            alert('Заполните все поля');
        }
        else{
            $.ajax({
                type: 'POST',
                cache: false,
                dataType: 'JSON',
                url: 'orders',
                data: {
                    action: 'create',
                    name: $('#new_name').val(),
                    email: $('#new_email').val(),
                    phone: $('#new_phone').val()
                },
                success: function(data){
                    $('#newOrder').before(function(){
                        return "<tr>" +
                            "<td class='id'>" +data.id+ "</td>" +
                            "<td class='name'>" +data.name+ "</td>" +
                            "<td class='email'>" +data.email+ "</td>" +
                            "<td class='phone'>" +data.phone+ "</td>" +
                            "<td>" +
                            "<a href='/orders_details?id=" +data.id+ "'>Подробнее...</a>" +
                            "<button id='deleteOrder'>Удалить</button><button id='updateOrder'>Обновить</button>" +
                            "</td>" +
                            "</tr>"
                    });
                }
            });
        }
    });

    body.on('click','#deleteOrder',function() {
        var elem = $(this).parent().parent();
        $.ajax({
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            url: 'orders',
            data: {
                action: 'delete',
                id: $(this).parent().siblings('.id').html(),
            },
            success: function (data) {
                elem.remove();
            }
        });
    });

    body.on('click','#updateOrder',function() {
        //console.log($(this).parent().siblings('.name').html());
        $(this).parent().siblings('.name').html('<input class="input-name" value="'+$(this).parent().siblings('.name').html()+'"/>');
        $(this).parent().siblings('.email').html('<input class="input-email" value="'+$(this).parent().siblings('.email').html()+'"/>');
        $(this).parent().siblings('.phone').html('<input class="input-phone" value="'+$(this).parent().siblings('.phone').html()+'"/>');
        $(this).parent().append('<button id="confirmOrder">Подтвердить</button>');
        $(this).parent().append('<button id="cancelOrder">Отменить</button>');
        $(this).remove();
    });

    body.on('click','#confirmOrder',function() {
        if(!$(this).parent().siblings('.id').html()
            || !$(this).parent().siblings('.name').children('.input-name').val()
            || !$(this).parent().siblings('.email').children('.input-email').val()
            || !$(this).parent().siblings('.phone').children('.input-phone').val())
        {
            alert('Заполните все поля');
        }
        else{
            var confirmButton = $(this);
            var cancelButton = $(this).siblings('#cancelOrder');
            $.ajax({
                type: 'POST',
                cache: false,
                dataType: 'JSON',
                url: 'orders',
                data: {
                    action: 'update',
                    id: $(this).parent().siblings('.id').html(),
                    name: $(this).parent().siblings('.name').children('.input-name').val(),
                    email: $(this).parent().siblings('.email').children('.input-email').val(),
                    phone: $(this).parent().siblings('.phone').children('.input-phone').val(),
                },
                success: function (data) {
                    confirmButton.parent().siblings('.name').html(data.name);
                    confirmButton.parent().siblings('.email').html(data.email);
                    confirmButton.parent().siblings('.phone').html(data.phone);
                    confirmButton.parent().append('<button id="updateOrder">Обновить</button>');
                    confirmButton.remove();
                    cancelButton.remove();
                }
            });
        }
    });

    body.on('click','#cancelOrder',function() {
        var cancelButton = $(this);
        var confirmButton = $(this).siblings('#confirmOrder');
        confirmButton.parent().siblings('.name').html(confirmButton.parent().siblings('.name').children('input').val());
        confirmButton.parent().siblings('.email').html(confirmButton.parent().siblings('.email').children('input').val());
        confirmButton.parent().siblings('.phone').html(confirmButton.parent().siblings('.phone').children('input').val());
        confirmButton.parent().append('<button id="updateOrder">Обновить</button>');
        confirmButton.remove();
        cancelButton.remove();
    });
});
