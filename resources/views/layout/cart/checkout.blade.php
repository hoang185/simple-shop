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
                                            <form class="form-checkout" method="post" action="">
                                                <fieldset class="fieldset">
                                                    <div class="field">
                                                        <label class="label">
                                                            <span>Email xác nhận đơn hàng</span>
                                                        </label>
                                                        <div class="control">
                                                            <input type="email" class="input-text">
                                                        </div>
                                                    </div>
                                                    <div class="field">
                                                        <label class="label">
                                                            <span>Điện thoại (Di động)</span>
                                                        </label>
                                                        <div class="control">
                                                            <input type="number" class="input-text">
                                                        </div>
                                                    </div>
                                                    <div class="choice field">
                                                        <input type="checkbox" name="mail-check">
                                                        <label for="is_subscribed" class="label">
                                                            <span>Tôi muốn nhận bản tin của Simple qua email</span>
                                                        </label>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                        <div class="custom-address-info">
                                            <div class="title">Thông tin giao hàng</div>
                                            <form class="form-shipping-address">
                                                <div class="fieldset address">
                                                    <div class="field _required">
                                                        <label class="label">
                                                            <span>Họ và Tên</span>
                                                        </label>
                                                        <div class="control">
                                                            <input class="input-text" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="field _required">
                                                        <label class="label">
                                                            <span>TỈNH/THÀNH PHỐ</span>
                                                        </label>
                                                        <div class="control">
                                                            <input class="input-text" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="field _required">
                                                        <label class="label">
                                                            <span>QUẬN/HUYỆN</span>
                                                        </label>
                                                        <div class="control">
                                                            <input class="input-text" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="field _required">
                                                        <label class="label">
                                                            <span>PHƯỜNG/XÃ</span>
                                                        </label>
                                                        <div class="control">
                                                            <input class="input-text" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="field _required">
                                                        <label class="label">
                                                            <span>ĐỊA CHỈ GIAO HÀNG</span>
                                                        </label>
                                                        <div class="control">
                                                            <input class="input-text" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                <li class="checkout-shipping-method">
                                    <div class="field">
                                        <label class="label">
                                            <span>Ghi chú</span>
                                        </label>
                                        <div class="control">
                                            <textarea class="admin__control-textarea" placeholder="Ghi chú cho đơn hàng"></textarea>
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
@endsection
