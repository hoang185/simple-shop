@extends('app')

@section('page.title', 'name-item')

@section('content')
    @include('sweetalert::alert')
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
                           @if($product->product_sale == 1)
                               <p class="current">{{ number_format($product->price,0,',','.') }}&nbsp<span class="currency-symbol">đ</span></p>
                               <p class="discount">{{ number_format($product->sale_price,0,',','.') }}&nbsp<span class="currency-symbol">đ</span></p>
                           @else
                               <p>{{ number_format($product->price,0,',','.') }}&nbsp<span class="currency-symbol">đ</span></p>
                           @endif
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
                                               <input class="input-text qty" type="number" name="qty" id="qty" value="1" data-value="1">
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
                        @if(count(Cart::content()) > 0)
                            @php $product_cart = Cart::content() @endphp
                            @foreach( $product_cart as $item)
                                <li class="item product" data-value="{{ $item->rowId  }}" role="tab">
                                    <div class="product">
                                        <div class="product-item-photo">
                                            <a href="#">
                                        <span>
                                            <span><img src="{{ $item->options['image'] }}"></span>
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
                                                <a href="#">{{ $item->name }}</a>
                                            </strong>
                                            <div class="product-item-option">
                                                <span>{{ $item->options['size'] }} / {{ $item->options['color'] }}</span>
                                            </div>
                                            <div class="product-item-price">
                                                <span>{{ $item->price }}&nbsp;đ</span>
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
                                @endforeach
                        @endif

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
            var qty = parseInt($('#'+qtyInput).val());
            if( qty < 100) {
                qty++;
                $('#'+qtyInput).val(qty);
                $('#'+qtyInput).attr('data-value',qty);
            }
            else {
                $('#'+qtyInput).val(100);
            }
        }
        function minusQty(qtyInput) {
            var qty = parseInt($('#'+qtyInput).val());
            if( qty > 1) {
                qty--;
                $('#'+qtyInput).val(qty);
                $('#'+qtyInput).attr('data-value',qty);
            }
            else {
                $('#'+qtyInput).val(1);
            }
        }
        $(document).ready(function () {
            var product_size = $('.action-size').text();
            console.log(product_size)

            $('.button-size').click(function () {
                    $('.action-size').removeClass('action-size');
                    $(this).addClass('action-size');
                    product_size = $('.action-size').text();
            });

            $('.product-color li:eq(0) button').addClass('action-color');
            let id = $('.action-color').val();
            $('.image-'+id).addClass('action-image');
            var product_color = $('.action-color').attr('data-title');
            var product_color_id = $('.action-color').val();

            console.log(product_color, 'color')
            $('.button-color').click(function () {
                    $('.action-color').removeClass('action-color');
                    $(this).addClass('action-color');
                    product_color = $('.action-color').attr('data-title');
                    product_color_id = $('.action-color').val();
                $('.product-image').removeClass('action-image');
                    let id = $('.action-color').val();
                    $('.image-' + id).addClass('action-image');
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


            $('.cart-close').click(function () {
                $('.cart-nav').css('right', '-100%');
            });




            var product_id = {{ $product->id }};

            $('#addtocart-button').click( function(e){
                e.preventDefault();
                var product_qty = $('#qty').val();
                console.log(product_color, product_size, product_qty, product_id,'hello')

                $.ajax({
                    url: '{{ route('cart.add') }}',
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: product_id,
                        color_id: product_color_id,
                        color: product_color,
                        size: product_size,
                        qty: product_qty
                    },
                    success:function (data) {
                        if (data.success) {
                            $('#mini-cart').append(data.html);
                            $('#cart_qty').text(data.cart_qty);
                            // if(location.reload()) {
                                $('.cart-nav').css('right', '0%');

                            // }
                            var leng_item_cart = $('.item').length;
                            console.log(leng_item_cart, 'leng-item-cart');
                            for( let i = 0; i < leng_item_cart; i++) {
                                $('.item:eq('+i+') .ti-close').click(function(e) {
                                    console.log($('.item:eq('+i+')').attr('data-value'), 'data value');
                                    e.preventDefault();
                                    if(confirm('Bạn có chắc chắn muốn xóa sản phẩm này không ?')) {
                                        var del_id = $('.item:eq('+i+')').attr('data-value');
                                        $.ajax({
                                            url: '{{ route('cart.delete') }}',
                                            type: 'post',
                                            data: {
                                                _token: "{{ csrf_token() }}",
                                                del_id: del_id,
                                            },
                                            success: function(data) {
                                                if(data.success) {
                                                    // $('.item:eq('+i+')').css('display', 'none');
                                                    $('.item:eq('+i+')').addClass('off-item');
                                                    let leng_item_cart = $('.item').not('.off-item').length;
                                                    console.log('out of cart', leng_item_cart, 2)
                                                    if(leng_item_cart === 0) {
                                                        console.log('out of cart')
                                                        $('#mini-cart').append('<li style="list-style: none"><div style="text-align: center"><h5>Giỏ hàng rỗng</h5></div></li>');
                                                    }
                                                }
                                            }
                                        })
                                    }
                                });
                            }
                            console.log('success', data.cart_qty)
                        }
                    },

                })
            });
        });

    </script>
@endsection
