@extends('app')

@section('page.title', 'Simple - For Him')

@section('content')
    <section id="categories">
        <div class="categories-title">
            <h1 class="info-title">for him</h1>
            <p>Tất cả những sản phẩm Mới nhất nằm trong BST được mở bán Hàng Tuần sẽ được cập nhật liên tục tại đây.
                Chắc chắn bạn sẽ tìm thấy những sản phẩm Đẹp Nhất - Vừa Vặn Nhất - Phù Hợp nhất với phong cách của mình.
            </p>
        </div>
        <div class="categories-list">
            <ul class="for-him">
                <li><a href="#">áo khoác & áo blazer</a></li>
                <li><a href="#">áo thun</a></li>
                <li><a href="#">quần</a></li>
                <li><a href="#">len dệt</a></li>
                <li><a href="#">phụ kiện</a></li>
                <li><a href="#">sơ mi & áo kiểu</a></li>
                <li><a href="#">quần bò</a></li>
                <li><a href="#">quần short</a></li>
                <li><a href="#">giày</a></li>
                <li><a href="#">tú & ví</a></li>
                <li><a href="#">đồ bơi & đồ biển</a></li>
                <li><a href="#">hoddies & sweatshirt</a></li>
            </ul>
        </div>
        <div class="categories-filter">
            <div class="toolbar-sorter">
                <div class="form-item-select">
                    <select id="sorter" data-role="sorter" class="sorter-option">
                        <option value="" disabled hidden selected>Sắp xếp theo</option>
                        <option>Thứ tự chữ cái A-Z</option>
                        <option>Thứ tự chữ cái Z-A</option>
                        <option>Giá tăng dần</option>
                        <option>Giá giảm dần</option>
                        <option>Sản phẩm mới nhất</option>
                    </select>
                </div>
            </div>
            <div class="filter-list">
                <span class="list-trigger">for him <i class="ti-angle-down"></i></span>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var length = $('.for-him a').length;
            for(let i = 1; i<=length; i++) {
                if( $('ul li:nth-child('+i+')').length > 0) {
                    console.log("success")
                    $('ul li:nth-child('+i+')').click( function () {
                        console.log(i)
                        $('.active').removeClass('active');
                        $('ul li:nth-child('+i+')').addClass('active');
                    });
                }
            }
            $('.list-trigger').click( function(e) {
                console.log('trigger')
                $('.categories-list').toggle(
                    function () { $('.categories-list').css("display", "block")},
                    function () { $('.categories-list').css("display", "none")},
                ) ;
                e.stopPropagation();
            });
        });
        $(document).on("click", function (){
            if($('.categories-list').css("display") === "block") {
                $('.categories-list').css("display", "none") ;
            }
        });
    </script>
@endsection


