<div class="modal fade account-fee-popup" id="account-fee-popup" tabindex="-1" role="dialog" aria-labelledby="accountFeeLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <h3>{{__('site.account_fee_heading')}}</h3>

                    <div class="col-lg-12">
                        <div class="payment-method">
                            <input type="radio" name="payment-cod">
                            <label class="label">
                                Thanh toán khi nhận hàng
                            </label>
                        </div>
                        <div class="payment-method">
                            <input type="radio" name="payment-onepay">
                            <label class="label">
                                Thanh toán bằng ONEPAY
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row" style="float: right; margin: 15px;">
                    <button name="cancel" class="btn btn-popup-actions" id="btn-cancel">Hủy</button>
                    <button name="next" id="btn-next" type="button" class="btn btn-popup-actions btn-purple "
                            style="margin-right:15px;">Đặt Hàng</button>
                </div>
            </div>
        </div>
    </div>
</div>
