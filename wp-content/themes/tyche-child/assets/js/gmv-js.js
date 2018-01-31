/**
 * Created by gumidung on 10/12/17.
 */


$(function () {

    // group product: load value when first load
    $(".custom-form-variable").each(function () {
        var $thisSelect = $(this);

        var getArraySelect = [];
        $.each($(this).find('select'), function (index,value) {
            getArraySelect.push(value.value);
        });

        var getArrayAttribute = [];

        $.each($(this).find(".attribute-info"), function () {
            var getArray03 = [];

            $.each($(this).find(".attribute-type"), function () {
                getArray03.push($(this).text());
            });

            getArrayAttribute.push({
                attribute : getArray03,
                getId : parseInt($(this).find(".attribute-id").text()),
                price : $(this).find(".price").html()
            })

        });

        $.each(getArrayAttribute, function (index, value) {
            // console.log(value.attribute);

            var is_same = value.attribute.every(function(element, index) {
                        return element === getArraySelect[index];
                    });
            if(is_same) {
                $thisSelect.find("input.variation_id").attr("value",value.getId);
                $thisSelect.find(".custom-price").html(value.price);
            }

        })

    });

    //  group product: load value when change select box
    $('.custom-form-variable select').change(function(e){
        var $thisSelect = $(this);

        var getArrayAttribute = [];

        $.each($(this).parents('.custom-form-variable').find(".attribute-info"), function () {
            var getArray03 = [];

            $.each($(this).find(".attribute-type"), function () {
                getArray03.push($(this).text());
            });

            getArrayAttribute.push({
                attribute : getArray03,
                getId : parseInt($(this).find(".attribute-id").text()),
                price : $(this).find(".price").html()

            })

        });

        var getArraySelect = [];

        $.each($(this).parents('.custom-form-variable').find('select'), function(index,value){
            // console.log(value.value);

            getArraySelect.push(value.value);
        });


        $.each(getArrayAttribute, function (index, value) {
            // console.log(value.attribute);

            var is_same = value.attribute.every(function(element, index) {
                        return element === getArraySelect[index];
                    });
            if(is_same) {
                $thisSelect.parents(".custom-form-variable").find("input.variation_id").attr("value",value.getId);
                $thisSelect.parents(".custom-form-variable").find(".custom-price").html(value.price);

            }

        })


    });

    // group product: slider
    $('.group-product .group-product-slider').owlCarousel({
        loop:true,
        nav:true,
        touchDrag: false,
        mouseDrag: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1200:{
                items:3
            }
        }
    })

    $('.suggestion-item .suggestion-slide').owlCarousel({
        loop:true,
        nav:true,
        margin: 20,
        touchDrag: true,
        mouseDrag: true,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsive:{
            0:{
                items:2
            },
            1200:{
                items:5
            }
        }
    });

    // $(".suggestion-item .custom-owl-nav .owl-next").click(function () {
    //     $(".suggestion-item .suggestion-slide .owl-nav .owl-next").click();
    // });
    //
    // $(".suggestion-item .custom-owl-nav .owl-prev").click(function () {
    //     $(".suggestion-item .suggestion-slide .owl-nav .owl-prev").click();
    // });
    //
    // $(".suggestion-item > .clearfix").hover(function () {
    //     $('.suggestion-item .suggestion-slide').trigger('stop.owl.autoplay')
    // }, function () {
    //     $('.suggestion-item .suggestion-slide').trigger('play.owl.autoplay',[1000])
    // });

    $(".custom-filter-mobile").click(function () {
        $(".custom-sidebar").slideToggle(300);
    });

    $('.block-slide-product').owlCarousel({
        loop:true,
        nav:true,
        margin: 20,
        touchDrag: true,
        mouseDrag: true,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsive:{
            0:{
                items:2
            },
            1200:{
                items:5
            }
        }
    });

//    Check if function is null product

    var $nullProduct = $(".hidden-search-no-result");
    if($nullProduct.length > 0) {
        $nullProduct.parents("body.tax-product_cat").addClass("null-product-archive");
        $nullProduct.parents("body.tax-product_cat").find(".custom-sidebar").parent('.col-xs-12.col-md-3').remove();
    }

    $(".add_to_cart_button").click(function () {
        alert('Sản phẩm đã được thêm vào giỏ hàng!');
    })

    $('.zen-navigation .custom-menu > li > .dropdown-menu').each(function () {
        $(this).width($('.container').width() - 200 - 30);
    })
});

$(window).resize(function () {
    $('.zen-navigation .custom-menu > li > .dropdown-menu').each(function () {
        $(this).width($('.container').width() - 200 - 30);
    })
})
