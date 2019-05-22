$( document ).ready(function() {
    let countLeft;
    let countFirst;
    let countMore;
    $('.basket').on("click", ".btn_order", function(){
        $.ajax({
            type: "POST",
            url: "/ajax/closecart",
            data: "cart_id="+$(this).data('cart_id'),
            success: function(msg){
                $('.basket').html(msg);
            }
        });
        alert("Заказ отправлен!");
    });
    
    $('.basket').on("click", ".btn_del", function(){
        $.ajax({
            type: "POST",
            url: "/ajax/delitem",
            data: "action=del&id="+$(this).data('id'),
            success: function(msg){
                //$("#cartinfo").text(msg);
                console.log (msg);
            }
        });
        $.ajax({
            type: "POST",
            url: "/ajax/drawcart",
            success: function(msg){
                $('.basket').html(msg);
            }
        });
    });
    $('.btn_next').click( function(){
        if(countFirst==undefined)
            countFirst = $(this).data('countfirst');
        if(countLeft==undefined)
            countLeft = $(this).data('countleft');
        if(countMore==undefined)
            countMore = $(this).data('more');
        //alert(countFirst+" "+ countLeft +" "+countMore);
        if((countLeft-countMore) >= countMore){
            $.ajax({
                    type: "POST",
                    url: "/ajax/drawmoreitems",
                    data: "action=more&first="+countFirst+"&more="+countMore,
                    success: function(msg){
                        //console.log (msg);
                        countLeft -= countMore;
                        countFirst += countMore;
                        //alert(countFirst+":"+countLeft);
                        buffer =  $('.catalog').html();
                        $('.catalog').html(buffer+msg);
                        if(countLeft<=0)
                            $('.btn_next').hide( "slow" );
                        else if(countLeft < countMore){
                            $('.btn_next').text("ЕЩЁ "+ countLeft);
                        }
                    }
            });
        } else{
            $.ajax({
                type: "POST",
                url: "/ajax/drawmoreitems",
                data: "action=more&first="+countFirst+"&more="+countMore,
                success: function(msg){
                    //console.log (msg);
                    countLeft -= countMore;
                    countFirst += countMore;
                    //alert(countFirst+":"+countLeft);
                    buffer =  $('.catalog').html();
                    $('.catalog').html(buffer+msg);
                    if(countLeft<=0)
                        $('.btn_next').hide( "slow" );
                }
            });
        }
    });
    $('.btn_buy').click( function() {
        if(!$(this).hasClass("incart")){
            $(this).html("В корзине").addClass('incart');
            $.ajax({
                type: "POST",
                url: "/ajax/additem",
                data: "action=add&id="+$(this).data('idgoods'),
                success: function(msg){
                    //$("#cartinfo").text(msg);
                    console.log (msg);
                }
            });
        }
        else{
            $(this).html("Купить").removeClass("incart");
            $.ajax({
                type: "POST",
                url: "/ajax/delitem",
                data: "action=del&id="+$(this).data('idgoods'),
                success: function(msg){
                    //$("#cartinfo").text(msg);
                    console.log (msg);
                }
            });
        }
    });
});