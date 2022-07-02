function addtocart(id){
    $.ajax({
        type: "POST",
        url: "{{ url('products/cart') }}",
        data: {
            qty: 1,
            product_id: id
        },
        dataType: "json",
            success: function (response) {
            $('.cart-counter').html('<i class="fas fa-shopping-cart fa-fw"></i> <span>'+response.cartcount+'</span>');
        }
    });
}

$(function () {
    $('#div-product-list').html('');
    $.ajax({
        url: 'api/web/getproductlist',
        type: "GET",
        dataType: 'json',
    })
    .done(function(result) {
        if (result.response == 200) 
        {
            $.each( result.products, function( key, value ) {
                var content = '';
                content = '<div class="col-md-3">'+
                            '<div class="card tronics">'+
                                '<div class="card-body tronics-wrap">'+
                                    '<div class="text-center">';
                                        if (value.photo != '') {
                                            content += '<img src="'+ value.photo.photo +'" class="img-fluid product-photo">';
                                        }
                            content += '<h3 class="product-name">'+ value.model +'</h3>'+
                                        '<div class="tronics-links">'+
                                            '<div style="padding-bottom: 5px;">'+
                                                '<a href="javascript:void(0)" onclick="addtocart('+value.id+')" class="btn btn-warning btn-sm"><i class="fas fa-shopping-cart fa-fw"></i> Add to Cart</a>'+
                                            '</div>'+
                                            '<a href="/products/'+ value.model +'-'+ value.id +'" class="btn btn-outline-warning btn-sm"><i class="fas fa-search fa-fw"></i> View Details</a>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
                
                $('#div-product-list').append(content);
            });



        }
    })
    .fail(function() {
        console.log("error");
    });


});