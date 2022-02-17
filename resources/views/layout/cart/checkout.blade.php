@extends('app')
@section('page.title', 'Thanh toán')

@section('content')
    <section id="checkout-pay">
        <div class="container-fluid" style="padding: 0 5%">
            <div class="row mb-lg-5">
                <div class="col-lg-12 main">
                    <div class="checkout-container">
                        <div class="checkout-info">
                            <ul class="checkout-step">
                                <li class="checkout-shipping-address">
                                    <div class="step-title">Nhập các chi tiết về việc gửi hàng</div>
                                    <div class="step-content">
                                        <div class="custom-contact-info">
                                            <div class="title">Thông tin liên hệ</div>
                                            @php
                                                $name = !empty(session('name')) ? session('name'): 0;
                                                $email = !empty(session('email')) ? session('email'): 0;
                                            @endphp
                                            <form id="form-checkout" class="form-checkout" method="post" action="{{ route('checkout.info')}}">
                                                @csrf
                                                <fieldset class="fieldset">
                                                    <div class="field">
                                                        <label class="label">
                                                            <span>Email xác nhận đơn hàng</span>
                                                        </label>
                                                        <div class="control">
                                                            @if(!empty($name))
                                                                <input name="email" type="email" class="input-text" value="{{ $email }}">
                                                            @else
                                                                <input name="email" type="email" class="input-text">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="field">
                                                        <label class="label">
                                                            <span>Điện thoại (Di động)</span>
                                                        </label>
                                                        <div class="control">
                                                            <input name="phone" type="number" class="input-text">
                                                        </div>
                                                    </div>
                                                    <div class="choice field">
                                                        <input type="checkbox" name="mail-check">
                                                        <label for="is_subscribed" class="label">
                                                            <span>Tôi muốn nhận bản tin của Simple qua email</span>
                                                        </label>
                                                    </div>
                                                    <div class="title">Thông tin giao hàng</div>
                                                    <div class="field _required">
                                                        <label class="label">
                                                            <span>Họ và Tên</span>
                                                        </label>
                                                        <div class="control">
                                                            @if(!empty($name))

                                                                <input name="name" class="input-text" value="{{ $name }}">
                                                            @else
                                                                <input name="name" class="input-text" type="text">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="field _required">
                                                        <label class="label">
                                                            <span>TỈNH/THÀNH PHỐ</span>
                                                        </label>
                                                        <div class="control">
                                                            <input name="city" class="input-text" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="field _required">
                                                        <label class="label">
                                                            <span>QUẬN/HUYỆN</span>
                                                        </label>
                                                        <div class="control">
                                                            <input name="district" class="input-text" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="field _required">
                                                        <label class="label">
                                                            <span>PHƯỜNG/XÃ</span>
                                                        </label>
                                                        <div class="control">
                                                            <input name="village" class="input-text" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="field _required">
                                                        <label class="label">
                                                            <span>ĐỊA CHỈ GIAO HÀNG</span>
                                                        </label>
                                                        <div class="control">
                                                            <input name="address" class="input-text" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="field">
                                                        <label class="label">
                                                            <span>Ghi chú</span>
                                                        </label>
                                                        <div class="control">
                                                            <textarea name="detail" class="admin__control-textarea"
                                                                      placeholder="Ghi chú cho đơn hàng"></textarea>
                                                        </div>
                                                    </div>

                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
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
                                                    <span class="price">{{ ($total>0) ?number_format($total,0,',','.'):0 }}&nbsp;đ</span>
                                                </td>
                                            </tr>
                                            <tr class="total-rules">
                                                <th class="mark" scope="row">
                                                    <span>MUA 1 GIẢM 10%</span>
                                                </th>
                                                <td class="amount">
                                                    <span class="rule-amount">{{ ($total>0) ?number_format($item_price->sale_price,0,',','.'):0 }}&nbsp;đ</span>
                                                </td>
                                            </tr>
                                            <tr class="totals shipping">
                                                <th class="mark" scope="row">
                                                    <span>Phí vận chuyển</span>
                                                </th>
                                                <td class="amount">
                                                    <span class="price">{{ number_format(intval($item_price->ship_price),0,',','.') }}&nbsp;đ</span>
                                                </td>
                                            </tr>
                                            <tr class="grand totals">
                                                <th class="mark" scope="row">
                                                    <strong>Tổng số</strong>
                                                </th>
                                                <td class="amount">
                                                    <strong>
                                                        <span class="price">{{ ($total>0) ?number_format($total+intval($item_price->ship_price),0,',','.'):0 }}&nbsp;đ</span>
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
                                            <button class="primary checkout checkout-button">
                                                <span>đặt hàng</span>
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
        </div>
    </section>
    <script>
        $(document).ready(function() {



            $("#form-checkout").validate({
                onfocusout: false,
                onkeyup: false,
                onclick: false,
                rules: {
                    "name": {
                        required: true,
                    },
                    "email": {
                        required: true,
                    },
                    "phone": {
                        required: true,
                    },
                    "city": {
                        required: true,
                    },
                    "district": {
                        required: true,
                    },
                    "village": {
                        required: true,
                    },
                    "address": {
                        required: true,
                    },

                },

            });
            $('.checkout-button').click( function(e) {
                if($("#form-checkout").valid()) {
                    $('#form-checkout').submit()
                }
            });

        });
    </script>
@endsection
