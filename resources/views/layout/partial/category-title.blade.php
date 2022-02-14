<div class="categories-title">
    @if( $slug == SEARCH_RESULT)
        <h1 class="info-title">{{ $slug }}&nbsp;:<span style="font-family: Condensed-Regular; font-size: 18px">&nbsp;{{ $search }}</span></h1>
    @else
        <h1 class="info-title">{{ $slug }}</h1>
    @endif
    @if( $slug == SEARCH_RESULT && isset($count) && $count == 0)
        <p>TÌM KIẾM CỦA BẠN KHÔNG CÓ KẾT QUẢ</p>
    @endif
    <p>Tất cả những sản phẩm Mới nhất nằm trong BST được mở bán Hàng Tuần sẽ được cập nhật liên tục tại đây.
        Chắc chắn bạn sẽ tìm thấy những sản phẩm Đẹp Nhất - Vừa Vặn Nhất - Phù Hợp nhất với phong cách của mình.
    </p>
</div>
