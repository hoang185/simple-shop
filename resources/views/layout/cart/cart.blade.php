@extends('app')

@section('page.title', 'Giỏ mua hàng')
@section('content')
    <section id="cart-checkout">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart-container">
                    <form method="post" class="form form-cart" action="">
                        <div class="cart table-wrapper">
                            <div class="cart-header">
                                <h4>giỏ hàng</h4>
                                <span class="cart-header_item">
                                    @php $count = !empty(\Cart::content()->count()) ? \Cart::content()->count() : 0 @endphp
                                <span>{{ $count }}</span>&nbsp;sản phẩm
                            </span>
                            </div>
                            <ul id="shopping-cart-table" class="items">

                                @if(count(Cart::content()) > 0)
                                    @php $product_cart = Cart::content() @endphp
                                    @foreach( $product_cart as $item)
                                        <li class="item product " data-value="{{ $item->rowId  }}" role="tab">
                                            <div class="product">
                                                <div class="product-item-photo">
                                                    <a href="#">
                <span>
                    <span><img
                            src="{{ $item->options['image'] }}"></span>
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
                                                                    <input class="input-text qty" type="number" name="qty" id="qty-1" value="{{ $item->qty }}">
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
                    </form>
                    <div class="shopping-cart-summary">
                        <div class="cart-order-summary">
                            <div class="cart-totals">
                                <div class="summary-noti">
                                    <p>* Mọi thông tin của quý khách sẽ được bảo mật</p>
                                </div>
                                <div class="table-wrapper">
                                    <table class="table data totals">
                                        <tbody>
                                        <tr class="totals sub">
                                            <th class="mark" scope="row">Tạm tính</th>
                                            <td class="amount">
                                                <span class="price">480000&nbsp;đ</span>
                                            </td>
                                        </tr>
                                        <tr class="total-rules">
                                            <th class="mark" scope="row">
                                                <span>MUA 1 GIẢM 10%</span>
                                            </th>
                                            <td class="amount">
                                                <span class="rule-amount">-48.000&nbsp;đ</span>
                                            </td>
                                        </tr>
                                        <tr class="totals shipping">
                                            <th class="mark" scope="row">
                                                <span>Phí vận chuyển</span>
                                            </th>
                                            <td class="amount">
                                                <span class="price">0&nbsp;đ</span>
                                            </td>
                                        </tr>
                                        <tr class="grand totals">
                                            <th class="mark" scope="row">
                                                <strong>Tổng số</strong>
                                            </th>
                                            <td class="amount">
                                                <strong>
                                                    <span class="price">432.000&nbsp;đ</span>
                                                </strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="cart-summary">
                                <ul class="checkout-method-items">
                                    <li class="item">
                                        <button class="primary checkout">
                                            <a href="{{ route('pay.checkout') }}" style="text-decoration: none; color: #fff"><span>Tiến hành thanh toán</span></a>
                                        </button>
                                    </li>
                                    <li>
                                        <a href="{{ route('home') }}" class="action continue">
                                            <span>Tiếp tục mua hàng</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
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
        $(document).ready(function() {
            var leng_item_cart = $('.item').length;
            console.log(leng_item_cart, 'leng-item-cart');
            for( let i = 0; i < leng_item_cart; i++) {
                $('.item:eq('+i+') .ti-close').click(function(e) {
                    e.preventDefault();
                    if(confirm('Bạn có chắc chắn muốn xóa sản phẩm này không ?')) {
                        var del_id = $('.item:eq('+i+')').attr('data-value');
                        console.log($('.item:eq('+i+')').attr('data-value'));
                        $.ajax({
                            url: '{{ route('cart.delete') }}',
                            type: 'post',
                            data: {
                                _token: "{{ csrf_token() }}",
                                del_id: del_id,
                            },
                            success: function(data) {
                                if(data.success) {
                                    location.reload()
                                }
                            }
                        })
                        // $('.item:eq('+i+')').css('display', 'none');
                    }
                });
            }
        });
    </script>
@endsection

