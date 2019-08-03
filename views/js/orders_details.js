$(document).ready(function(){
    var body = $('body');
    body.on('click','#addProduct',function(){
        if( !$('#new_product_name').val() || !$('#new_product_price').val())
        {
            alert('Заполните все поля');
        }
        else{
            $.ajax({
                type: 'POST',
                cache: false,
                dataType: 'JSON',
                url: 'orders_details',
                data: {
                    action: 'create',
                    id: $('#order_id').val(),
                    name: $('#new_product_name').val(),
                    price: $('#new_product_price').val()
                },
                success: function(data){
                    $('#newProduct').before(function(){
                        return "<tr id='Products'>" +
                            "<td>" +data.id+ "</td>" +
                            "<td class='name'>" +data.name+ "</td>" +
                            "<td class='price'>" +data.price+ "</td>" +
                            "<td><button id='deleteProduct'>Удалить</button></td>" +
                            "</tr>";
                    });
                }
                /*error: function (error) {
                    console.log(error);
                }*/
            });
        }
    });

    body.on('click','#deleteProduct',function() {
        var elem = $(this).parent().parent();
        $.ajax({
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            url: 'orders_details',
            data: {
                action: 'delete',
                id: $(this).parent().siblings('.id').html(),
            },
            success: function (data) {
                //console.log(elem);
                elem.remove();
            }
        });
    });

    body.on('click','#updateProduct',function() {
        //console.log($(this).parent().siblings('.name').html());
        $(this).parent().siblings('.name').html('<input class="input-name" value="'+$(this).parent().siblings('.name').html()+'"/>');
        $(this).parent().siblings('.price').html('<input class="input-price" value="'+$(this).parent().siblings('.price').html()+'"/>');
        $(this).parent().append('<button id="confirmProduct">Подтвердить</button>');
        $(this).parent().append('<button id="cancelProduct">Отменить</button>');
        $(this).remove();
    });

    body.on('click','#confirmProduct',function() {
        if( !$(this).parent().siblings('.id').html()
            || !$(this).parent().siblings('.name').children('.input-name').val()
            || !$(this).parent().siblings('.price').children('.input-price').val())
        {
            alert('Заполните все поля!');
        }
        else{
            var confirmButton = $(this);
            var cancelButton = $(this).siblings('#cancelProduct');
            $.ajax({
                type: 'POST',
                cache: false,
                dataType: 'JSON',
                url: 'orders_details',
                data: {
                    action: 'update',
                    id: $(this).parent().siblings('.id').html(),
                    name: $(this).parent().siblings('.name').children('.input-name').val(),
                    price: $(this).parent().siblings('.price').children('.input-price').val()
                },
                success: function (data) {
                    confirmButton.parent().siblings('.name').html(data.name);
                    confirmButton.parent().siblings('.price').html(data.price);
                    confirmButton.parent().append('<button id="updateProduct">Обновить</button>');
                    confirmButton.remove();
                    cancelButton.remove();
                }
            });
        }
    });

    body.on('click','#cancelProduct',function() {
        var cancelButton = $(this);
        var confirmButton = $(this).siblings('#confirmProduct');
        confirmButton.parent().siblings('.name').html(confirmButton.parent().siblings('.name').children('input').val());
        confirmButton.parent().siblings('.price').html(confirmButton.parent().siblings('.price').children('input').val());
        confirmButton.parent().append('<button id="updateProduct">Обновить</button>');
        confirmButton.remove();
        cancelButton.remove();
    });
});
