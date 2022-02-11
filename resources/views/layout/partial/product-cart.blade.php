
    <li class="item product " data-value="{{ $product_cart->rowId }}" role="tab">
    <div class="product">
        <div class="product-item-photo">
            <a href="#">
                <span>
                    <span><img
                            src="{{ $product_cart->options['image'] }}"></span>
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
                    <a href="#">{{ $product_cart->name }}</a>
                </strong>
                <div class="product-item-option">
                    <span>{{ $product_cart->options['size'] }} / {{ $product_cart->options['color'] }}</span>
                </div>
                <div class="product-item-price">
                    <span>{{ $product_cart->price }}&nbsp;đ</span>
                </div>
            <div class="box-tocart">
                <div class="fieldset">
                    <div class="field qty">
                        <div class="control">
                            <span class="edit-qty minus" onclick="minusQty('qty-1')">-</span>
                            <input class="input-text qty" type="number" name="qty" id="qty-1" value="{{ $product_cart->qty }}">
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
