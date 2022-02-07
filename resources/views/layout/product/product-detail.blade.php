@extends('app')

@section('page.title', 'name-item')

@section('content')
<section id="product-detail">
   <div class="container-fluid">
       <div class="row">
           <div class="col-lg-6 col-sm-6 product-gallery">
               <ul>
                   @foreach( $attributes as $attribute)
                       <li class="image-{{ $attribute->product_color_id }} product-image" style="background-image: url('{{ $attribute->image_1 }}')"></li>
                       <li class="image-{{ $attribute->product_color_id }} product-image" style="background-image: url('{{ $attribute->image_2 }}')"></li>
                       <li class="image-{{ $attribute->product_color_id }} product-image" style="background-image: url('{{ $attribute->image_3 }}')"></li>
                       <li class="image-{{ $attribute->product_color_id }} product-image" style="background-image: url('{{ $attribute->image_4 }}')"></li>
                   @endforeach
               </ul>
           </div>
           <div class="col-lg-6 col-sm-6 product-info">
               <div class="product-detail-info">
                   <div class="product-info-main">
                       <div class="product-info-top">
                           <h1 class="product-info-name">{{ $product->name }}</h1>
                       </div>
                       <div class="product-info-price">
                           <p class="current">{{ number_format($product->price,0,',','.') }}&nbsp<span class="currency-symbol">đ</span></p>
                           <p class="discount">{{ number_format($product->sale_price,0,',','.') }}&nbsp<span class="currency-symbol">đ</span></p>
                       </div>
                       <div class="product-add-form">
                           <div class="product-options-wrapper">
                               <div class="swatch-opt">
                                   <div class="swatch-attribute color">
                                       <span class="swatch-attribute-label">Màu trang phục </span>
                                       <ul class="swatch-attribute-options product-color">
                                           @foreach($attributes as $attribute)
                                               <li>
                                                   <button class="button-color" value="{{ $attribute->product_color_id }}" data-title="{{ $attribute->color }} " {{ ($attribute->status == 1) ?'': 'disabled' }} style="background-image: url('{{ $attribute->color_thumb }}');"></button>
                                               </li>
                                           @endforeach
                                       </ul>
                                   </div>
                                   <div class="swatch-attribute size">
                                       <span class="swatch-attribute-label">Kích cỡ</span>
                                       <ul class="swatch-attribute-options">
                                           @php $array_size = explode(',', $product->size) @endphp
                                           <li>
                                               <button class="button-size action-size" value="1">{{ SIZE_XS }}</button>
                                           </li>
                                           <li>
                                               <button class="button-size" value="2">{{ SIZE_S }}</button>
                                           </li>
                                           <li>
                                               <button class="button-size" value="3">{{ SIZE_M }}</button>
                                           </li>
                                           <li>
                                               <button class="button-size" value="4">{{ SIZE_L }}</button>
                                           </li>
                                           <li>
                                               <button class="button-size" value="5">{{ SIZE_XL }}</button>
                                           </li>
                                           <li>
                                               <button class="button-size" value="5">{{ SIZE_XXL }}</button>
                                           </li>
                                       </ul>
                                   </div>
                               </div>
                           </div>
                           <div class="product-options-bottom">
                               <a class="action size-guide">
                                   <span>Tìm cỡ của bạn</span>
                               </a>
                               <div class="box-tocart">
                                   <div class="fieldset">
                                       <div class="field qty">
                                           <div class="control">
                                               <span class="edit-qty minus" onclick="minusQty('qty')">-</span>
                                               <input class="input-text qty" type="number" name="qty" id="qty" value="1">
                                               <span class="edit-qty plus" onclick="plusQty('qty')">+</span>
                                           </div>
                                       </div>
                                       <div class="actions">
                                           <button type="submit" class="tocart" id="addtocart-button">
                                               <span>Thêm vào giỏ hàng</span>
                                           </button>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="product-info-banner">
                           <p class="banner-content">
                               <a href="#">
                                   <img src="https://res.cloudinary.com/simpleshop/image/upload/v1643038972/simple-shop/banner/small-banner/bannersale-01_ykl5ao.jpg">
                               </a>
                           </p>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>

    <div class="modal fade" id="size-guide-popup">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hướng dẫn chọn size</h4>
                    <button type="button" class="close" data-dismiss="modal" style="margin-right: 0px">&times;</button>
                </div>
                <div class="modal-body">
                    <p>
                        <img src="https://res.cloudinary.com/simpleshop/image/upload/v1643210336/simple-shop/banner/color-size-image/M_shirt_loose_ujeoin.jpg">
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-nav">
        <div class="cart-nav-content" data-action="scroll">
            <div class="cart-top">
                <i class="ti-bag" style="font-size: 28px;"></i>
                <div class="dot"><span class="qty-cart">22</span></div>
                <span class="cart-close">Đóng</span>
            </div>
            <div class="block-content">
                <div class="cart-item minicart-items-wrapper">
                    <ul id="mini-cart" class="minicart-item" role="tablist">
                        <li class="item product" role="tab">
                            <div class="product">
                                <div class="product-item-photo">
                                    <a href="#">
                                        <span>
                                            <span><img src="https://res.cloudinary.com/simpleshop/image/upload/v1643122910/simple-shop/nam/ARTHUR%20JACKET/1641047077794_bgxxqb.jpg"></span>
                                        </span>
                                    </a>
                                </div>
                                <div class="product-item-detail">
                                    <div class="secondary">
                                        <button class="close_button" id="close_button">
                                            <i class="ti-close" style="font-size: 15px"></i>
                                        </button>
                                    </div>
                                    <strong class="product-item-name">
                                        <a href="#">Arthur Jacket</a>
                                    </strong>
                                    <div class="product-item-option">
                                        <span>XS / Xanh Rêu</span>
                                    </div>
                                    <div class="product-item-price">
                                        <span>1.050.000&nbsp;đ</span>
                                    </div>
                                    <div class="box-tocart">
                                        <div class="fieldset">
                                            <div class="field qty">
                                                <div class="control">
                                                    <span class="edit-qty minus" onclick="minusQty('qty-1')">-</span>
                                                    <input class="input-text qty" type="number" name="qty" id="qty-1" value="1">
                                                    <span class="edit-qty plus" onclick="plusQty('qty-1')">+</span>
                                                </div>
                                                <button class="update-cart-item">
                                                    <span>Cập nhật</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item product" role="tab">
                            <div class="product">
                                <div class="product-item-photo">
                                    <a href="#">
                                        <span>
                                            <span><img src="https://res.cloudinary.com/simpleshop/image/upload/v1643122910/simple-shop/nam/ARTHUR%20JACKET/1641047077794_bgxxqb.jpg"></span>
                                        </span>
                                    </a>
                                </div>
                                <div class="product-item-detail">
                                    <div class="secondary">
                                        <button class="close_button" id="close_button">
                                            <i class="ti-close" style="font-size: 15px"></i>
                                        </button>
                                    </div>
                                    <strong class="product-item-name">
                                        <a href="#">Arthur Jacket</a>
                                    </strong>
                                    <div class="product-item-option">
                                        <span>XS / Xanh Rêu</span>
                                    </div>
                                    <div class="product-item-price">
                                        <span>1.050.000&nbsp;đ</span>
                                    </div>
                                    <div class="box-tocart">
                                        <div class="fieldset">
                                            <div class="field qty">
                                                <div class="control">
                                                    <span class="edit-qty minus" onclick="minusQty('qty-{{7}}')">-</span>
                                                    <input class="input-text qty" type="number" name="qty" id="qty-{{7}}" value="1">
                                                    <span class="edit-qty plus" onclick="plusQty('qty-{{7}}')">+</span>
                                                </div>
                                                <button class="update-cart-item">
                                                    <span>Cập nhật</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item product" role="tab">
                            <div class="product">
                                <div class="product-item-photo">
                                    <a href="#">
                                        <span>
                                            <span><img src="https://res.cloudinary.com/simpleshop/image/upload/v1643122910/simple-shop/nam/ARTHUR%20JACKET/1641047077794_bgxxqb.jpg"></span>
                                        </span>
                                    </a>
                                </div>
                                <div class="product-item-detail">
                                    <div class="secondary">
                                        <button class="close_button" id="close_button">
                                            <i class="ti-close" style="font-size: 15px"></i>
                                        </button>
                                    </div>
                                    <strong class="product-item-name">
                                        <a href="#">Arthur Jacket</a>
                                    </strong>
                                    <div class="product-item-option">
                                        <span>XS / Xanh Rêu</span>
                                    </div>
                                    <div class="product-item-price">
                                        <span>1.050.000&nbsp;đ</span>
                                    </div>
                                    <div class="box-tocart">
                                        <div class="fieldset">
                                            <div class="field qty">
                                                <div class="control">
                                                    <span class="edit-qty minus" onclick="minusQty('qty-3')">-</span>
                                                    <input class="input-text qty" type="number" name="qty" id="qty-3" value="1">
                                                    <span class="edit-qty plus" onclick="plusQty('qty-3')">+</span>
                                                </div>
                                                <button class="update-cart-item">
                                                    <span>Cập nhật</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="action">
                <div class="primary">
                    <button id="btn-checkout-cart" class="btn-cart-action">
                        <span>thanh toán ngay</span>
                    </button>
                </div>
                <div class="secondary">
                    <button id="btn-view-cart" class="btn-cart-action" style="background-color: #000; color: #fff">
                        <span>xem giỏ hàng</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>
    <script type="text/javascript">
        function plusQty(qtyInput) {
            let qty = parseInt($('#'+qtyInput).val());
            if( qty < 100) {
                qty++;
                $('#'+qtyInput).val(qty);
            }
            else {
                $('#'+qtyInput).val(100);
            }
        }
        function minusQty(qtyInput) {
            let qty = parseInt($('#'+qtyInput).val());
            if( qty > 1) {
                qty--;
                $('#'+qtyInput).val(qty);
            }
            else {
                $('#'+qtyInput).val(1);
            }
        }
        $(document).ready(function () {
            $('.button-size').click(function () {
                $('.action-size').removeClass('action-size');
                $(this).addClass('action-size');
            });
            $('.product-color li:eq(0) button').addClass('action-color');
            let id = $('.action-color').val();
            $('.image-'+id).addClass('action-image');
            $('.button-color').click(function () {
                $('.action-color').removeClass('action-color');
                $(this).addClass('action-color');
                console.log('action-colr', $('.action-color').val())
                $('.product-image').removeClass('action-image');
                let id = $('.action-color').val();
                $('.image-'+id).addClass('action-image');
            });

            $('.size-guide').click( function(){
                // $('#size-guide-popup').css("display", "block");
                $('#size-guide-popup').modal('show');
                // console.log('show')
            });
            var size = '{{ $product->size }}';
            var array_size = size.split(',');
            var leng_size = $('.button-size').length;
            // console.log(array_size, 'array size');
            for( let i = 0; i < leng_size; i++) {
                let val_size = $('.size li:eq('+i+') .button-size').val();
                if( array_size.indexOf(val_size) < 0) {
                    $('.size li:eq('+i+') .button-size').addClass('off-size');
                    $('.size li:eq('+i+') .button-size').attr('disabled', true);
                    // console.log('index', array_size.indexOf('0'))
                }
            }

            $('#addtocart-button').click(function () {
                $('.cart-nav').css('right', '0%');
            });
            $('.cart-close').click(function () {
                $('.cart-nav').css('right', '-100%');
            });

            var leng_item_cart = $('.item').length;
            console.log(leng_item_cart, 'leng-item-cart');
            for( let i = 0; i < leng_item_cart; i++) {
                $('.item:eq('+i+') .ti-close').click(function(e) {
                    e.preventDefault();
                    $('.item:eq('+i+')').css('display', 'none');
                });
            }
        });

    </script>
@endsection
