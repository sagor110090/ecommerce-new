"use strict";

$(window).on("load", function () {
    $(".loader").fadeOut("slow");
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function addtocart(id) {
    var data = {
        'product_id': $('#' + id).data("id"),
        'name': $('#' + id).data("name"),
        'thumbnail1': $('#' + id).data("thumbnail1"),
        'size': $('#' + id).data("size"),
        'color': $('#' + id).data("color"),
        'price': $('#' + id).data("price"),
        'slug': $('#' + id).data("slug"),
        'quantity': $('#' + id).data("quantity"),
    }
    $.ajax({
        type: "POST",
        url: "/cartStore",
        data: data,
        dataType: "json",
        success: function (response) {
            var cart = '<div id="cart-preview" >';
            $.each(response.items, function (indexInArray, valueOfElement) {
                cart += '<li><div class="cart-img"><a href="/product-details/' + valueOfElement.attributes.slug + '"><img src="' + valueOfElement.attributes.image + '" alt=""></a> </div> <div class="cart-info"> <h4><a href="/product-details/' + valueOfElement.attributes.slug + '">' + valueOfElement.name + '</a></h4><div class="cart-quantity"> quantity: <div class="quantity-amount">' + valueOfElement.quantity + ' pices </div> </div> <span>$' + valueOfElement.price * valueOfElement.quantity + ' </span></div> <div class="del-icon" id="remove' + valueOfElement.id + '" onclick="removeCart(' + valueOfElement.id + ')"> <i class="fa fa-times"></i> </div> </li>';

            });

            cart += '<li class="mini-cart-price"> <span class="subtotal">subtotal : </span> <span class="subtotal-price">$' + response.subTotal + ' </span>  </li> <li class="checkout-btn"> <a href="checkout">checkout</a> </li></div>';
            $('#cart-preview').replaceWith(cart);
            let subTotal = '<div class="cart-total-price" id="sub-total"> <span>total</span> $' + response.subTotal + '  </div>';
            let cartTotalQuantity = '<div id="cartTotalQuantity">' + response.cartTotalQuantity + '</div>';
            $('#sub-total').replaceWith(subTotal);
            $('#cartTotalQuantity').replaceWith(cartTotalQuantity);
            swal("Item add to the Cart :)");
        }
    });
}
$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/showCart",
        dataType: "json",
        success: function (response) {
            var cart = '<div id="cart-preview" >';
            if (response.items != '') {
                $.each(response.items, function (indexInArray, valueOfElement) {
                    cart += '<li><div class="cart-img"><a href="/product-details/' + valueOfElement.attributes.slug + '"><img src="' + valueOfElement.attributes.image + '" alt=""></a> </div> <div class="cart-info"> <h4><a href="/product-details/' + valueOfElement.attributes.slug + '">' + valueOfElement.name + '</a></h4><div class="cart-quantity"> quantity: <div class="quantity-amount">' + valueOfElement.quantity + ' pices </div> </div> <span>$' + valueOfElement.price * valueOfElement.quantity + ' </span></div> <div class="del-icon" id="remove' + valueOfElement.id + '" onclick="removeCart(' + valueOfElement.id + ')"> <i class="fa fa-times"></i> </div> </li>';

                });

                cart += '<li class="mini-cart-price"> <span class="subtotal">subtotal : </span> <span class="subtotal-price">$' + response.subTotal + ' </span>  </li> <li class="checkout-btn"> <a href="checkout">checkout</a> </li></div>';
                $('#cart-preview').replaceWith(cart);
                let subTotal = '<div class="cart-total-price" id="sub-total"> <span>total</span> $' + response.subTotal + '  </div>';
                let cartTotalQuantity = '<div id="cartTotalQuantity">' + response.cartTotalQuantity + '</div>';
                $('#sub-total').replaceWith(subTotal);
                $('#cartTotalQuantity').replaceWith(cartTotalQuantity);
            } else {
                let subTotal = '<div class="cart-total-price" id="sub-total"> <span>total</span> $' + response.subTotal + ' </div>';
                let cartTotalQuantity = '<div id="cartTotalQuantity">' + response.cartTotalQuantity + '</div>';
                $('#sub-total').replaceWith(subTotal);
                $('#cartTotalQuantity').replaceWith(cartTotalQuantity);


            }
        }
    });
});

function removeCart(id) {
    $.ajax({
        type: "GET",
        url: "/removeCartItem/" + id,
        dataType: "json",
        success: function (response) {
            var cart = '<div id="cart-preview" >';
            if (response.items != '') {
                $.each(response.items, function (indexInArray, valueOfElement) {
                    cart += '<li><div class="cart-img"><a href="/product-details/' + valueOfElement.attributes.slug + '"><img src="' + valueOfElement.attributes.image + '" alt=""></a> </div> <div class="cart-info"> <h4><a href="/product-details/' + valueOfElement.attributes.slug + '">' + valueOfElement.name + '</a></h4><div class="cart-quantity"> quantity: <div class="quantity-amount">' + valueOfElement.quantity + ' pices </div> </div> <span>$' + valueOfElement.price * valueOfElement.quantity + ' </span></div> <div class="del-icon" id="remove' + valueOfElement.id + '" onclick="removeCart(' + valueOfElement.id + ')"> <i class="fa fa-times"></i> </div> </li>';

                });

                cart += '<li class="mini-cart-price"> <span class="subtotal">subtotal : </span> <span class="subtotal-price">$' + response.subTotal + ' </span>  </li> <li class="checkout-btn"> <a href="checkout">checkout</a> </li></div>';
                $('#cart-preview').replaceWith(cart);
                let subTotal = '<div class="cart-total-price" id="sub-total"> <span>total</span> $' + response.subTotal + '  </div>';
                let cartTotalQuantity = '<div id="cartTotalQuantity">' + response.cartTotalQuantity + '</div>';
                $('#sub-total').replaceWith(subTotal);
                $('#cartTotalQuantity').replaceWith(cartTotalQuantity);
            } else {
                var cart = '<div id="cart-preview" ></div>';
                $('#cart-preview').replaceWith(cart);
                let subTotal = '<div class="cart-total-price" id="sub-total"> <span>total</span> $' + response.subTotal + '  </div>';
                let cartTotalQuantity = '<div id="cartTotalQuantity">' + response.cartTotalQuantity + '</div>';
                $('#sub-total').replaceWith(subTotal);
                $('#cartTotalQuantity').replaceWith(cartTotalQuantity);


            }
        }
    });
}

function quick_view(id) {
    let product_id = $('#' + id).data("id");
    let name = $('#' + id).data("name");
    let size = $('#' + id).data("size");
    let color = $('#' + id).data("color");
    let price = $('#' + id).data("price");
    let quantity = $('#' + id).data("quantity");

    let thumbnail1 = $('#' + id).data("thumbnail1");
    let short_description = $('#' + id).data("short_description");
    let image1 = $('#' + id).data("image1");
    let image2 = $('#' + id).data("image2");
    let image3 = $('#' + id).data("image3");
    let slug = $('#' + id).data("slug");

    var sampleInput = short_description,
        sampleInputLength = sampleInput.length;

    if (sampleInputLength >= 155) {
        sampleInput = sampleInput.substr(0, 150) + ".....";
    }
    console.log(sampleInput);

    $('#charCounter').text(sampleInputLength);
    $('#sampleOutput').text(sampleInput);
    let viewAdd = '<div id="product-quick-view" class="col-lg-5"> <div class="product-large-slider slick-arrow-style_2 mb-20">  <div class="pro-large-img"> <img src="' + image1 + '"  alt="" />  </div> </div></div>';

    let quick_product_info = '<div id="quick-product-info"><h3><a href="/product-details/' + slug + '">' + name + '</a></h3> <div id="product-availability" class="availability mt-10"> <h5>Availability:</h5> <span>' + quantity + ' in stock</span></div> <div class="pricebox" id="price-pricebox"> <span class="regular-price">$' + price + ' </span>  </div><div  class="availability mt-10"> <h5>Size:</h5> <span>' + size + '</span></div><div  class="availability mt-10"> <h5>Color:</h5> <span>' + color + '</span></div>' + sampleInput + '</div>';

    $('#product-quick-view').replaceWith(viewAdd);
    $('#quick-product-info').replaceWith(quick_product_info);

    let cartBtn = '<div class="action_link" id="quickViewCartBtn"><a class="buy-btn" id="add-to-cart-quick-view' + product_id + '" onclick="addtocartquickview(this.id)" data-placement="left" data-id="' + product_id + '" data-name="' + name + '" data-price="' + price + '" data-quantity="3" data-thumbnail1="' + thumbnail1 + '" data-color="' + color + '" data-size="' + size + '" href="javascript:0">add to cart<i class="fa fa-shopping-cart"></i></a></div>';
    $('.action_link').replaceWith(cartBtn);
}
$('#quantity-value').change(function (e) {
    e.preventDefault();

    alert($(this).val());
    $('.buy-btn').attr('data-quantity', 10);
});
function addtocartquickview(id) {
    var data = {
        'product_id': $('#' + id).data("id"),
        'name': $('#' + id).data("name"),
        'thumbnail1': $('#' + id).data("thumbnail1"),
        'size': $('#' + id).data("size"),
        'color': $('#' + id).data("color"),
        'price': $('#' + id).data("price"),
        'quantity': $('.quantity-value').val(),
        'slug': $('#' + id).data("slug"),
    }
    $.ajax({
        type: "POST",
        url: "/cartStore",
        data: data,
        dataType: "json",
        success: function (response) {
            var cart = '<div id="cart-preview" >';
            $.each(response.items, function (indexInArray, valueOfElement) {
                cart += '<li><div class="cart-img"><a href="/product-details/' + valueOfElement.attributes.slug + '"><img src="' + valueOfElement.attributes.image + '" alt=""></a> </div> <div class="cart-info"> <h4><a href="/product-details/' + valueOfElement.attributes.slug + '">' + valueOfElement.name + '</a></h4><div class="cart-quantity"> quantity: <div class="quantity-amount">' + valueOfElement.quantity + ' pices </div> </div> <span>$' + valueOfElement.price * valueOfElement.quantity + ' </span></div> <div class="del-icon" id="remove' + valueOfElement.id + '" onclick="removeCart(' + valueOfElement.id + ')"> <i class="fa fa-times"></i> </div> </li>';

            });

            cart += '<li class="mini-cart-price"> <span class="subtotal">subtotal : </span> <span class="subtotal-price">$' + response.subTotal + ' </span>  </li> <li class="checkout-btn"> <a href="checkout">checkout</a> </li></div>';
            $('#cart-preview').replaceWith(cart);
            let subTotal = '<div class="cart-total-price" id="sub-total"> <span>total</span> $' + response.subTotal + ' </div>';
            let cartTotalQuantity = '<div id="cartTotalQuantity">' + response.cartTotalQuantity + '</div>';
            $('#sub-total').replaceWith(subTotal);
            $('#cartTotalQuantity').replaceWith(cartTotalQuantity);
            swal("Item add to the Cart :)");
        }
    });
}

function updateForm() {
    $("#updateCartForm").submit();
}

function wishlistStore(id) {
    var data = {
        'product_id': $('#' + id).data("id"),
    }
    $.ajax({
        type: "GET",
        url: "/wishlistStore",
        data: data,
        dataType: "json",
        success: function (response) {
            swal("Item add to wishlist:)");
        },
        error: function (data) {
            var errors = data.responseJSON; // An array with all errors.
            if (errors) {
                swal(errors.errors.product_id[0]);
            } else {
                swal("you need login first :)");
            }
        }
    });
}
$('#btnOrder').click(function (e) {
    e.preventDefault();
    $('#orderForm').submit();
});

$('#search').click(function (e) {
    $('#search-input-set').val($('#search-input-get').val())
    $('.search-form').submit();

});

function compare(product_id) {
    $.ajax({
        type: "GET",
        url: "/compare/" + product_id,
        dataType: "json",
        success: function (response) {
            swal(response);
        },
        error: function (response) {
            swal("you need login first :)");
        }
    });
}