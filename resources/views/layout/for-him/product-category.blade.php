@extends('app')

@section('page.title', $for_him.': '.$page_title->category)

@section('content')
    <section id="categories">
        <div class="categories-title">
            <h1 class="info-title">{{ $page_title->category }}</h1>
            <p>Tất cả những sản phẩm Mới nhất nằm trong BST được mở bán Hàng Tuần sẽ được cập nhật liên tục tại đây.
                Chắc chắn bạn sẽ tìm thấy những sản phẩm Đẹp Nhất - Vừa Vặn Nhất - Phù Hợp nhất với phong cách của mình.
            </p>
        </div>
        <div class="categories-list">
            <ul class="for-him">
                @foreach( $categories as $category)
                    <li><a href="{{ route('for-him.category', ['cat' => $category->categoryvi]) }}">{{ $category->category }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="categories-filter">
            <div class="toolbar-sorter">
                <div class="form-item-select">
                    <select id="sorter" data-role="sorter" class="sorter-option">
                        <option value="0" disabled hidden selected>Sắp xếp theo</option>
                        <option value="{{ route('for-him.category', ['cat' => $cat,'sorter' => 1]) }}">Thứ tự chữ cái A-Z</option>
                        <option value="{{ route('for-him.category', ['cat' => $cat,'sorter' => 2]) }}">Thứ tự chữ cái Z-A</option>
                        <option value="{{ route('for-him.category', ['cat' => $cat,'sorter' => 3]) }}">Giá tăng dần</option>
                        <option value="{{ route('for-him.category', ['cat' => $cat,'sorter' => 4]) }}">Giá giảm dần</option>
                        <option value="{{ route('for-him.category', ['cat' => $cat,'sorter' => 5]) }}">Sản phẩm mới nhất</option>
                    </select>
                </div>
            </div>
            <div class="filter-list" id="trigger">
                <div>
                    <span class="list-trigger" style="z-index: 99;text-transform: capitalize; cursor: pointer;">{{ $for_him }} <i class="ti-angle-down" style="font-size: 12px"></i></span>
                </div>
            </div>
        </div>
        <div class="categories-product">
            <ul class="product-list">
                @foreach( $products as $product)
                    <li>
                        <div class="product">
                            <div class="thumnail">
                                <a href="#"><span style="background-image:url( {{ $product->image }})" alt=""></span></a>
                                <div>
                                    <div class="detail">
                                        <h6 class="name">{{ $product->name }}</h6>
                                        <div class="price">
                                            <p>{{ number_format($product->price) }}đ</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{ $products->links('vendor.pagination.bootstrap-4') }}

        </div>

    </section>
@endsection
@section('scripts')
    <script src="https://pagination.js.org/dist/2.1.5/pagination.min.js"></script>
    <script type="text/javascript">
        var csrf = "{{ csrf_token() }}" ;
        var category = '';
        $(document).ready(function () {
            var url = $(location).attr('href');
            var parts = url.split("/");
            console.log(parts, 'parts')
            var last_part = parts[parts.length-1];
            console.log(last_part, 'last param url');

            var leng_option = $('#sorter option').length;
            console.log(url, 'url');

            for(let i = 2; i <= leng_option; i++) {
                var value_option = $('#sorter option:nth-child(' + i +')').val().split("/");
                var last_value_option = value_option[value_option.length-1];
                console.log(last_value_option, 'val op');
                if( last_value_option === last_part) {
                    $('#sorter option:nth-child(' + i +')').attr('selected', true);
                }
            }

            var searchParams = new URLSearchParams(window.location.search);
            var page = 1;
            if(searchParams.has('page')){
                page = searchParams.get('page');
            }
            console.log(page);

            if (window.matchMedia('screen and (max-width: 768px)').matches) {
                $('.list-trigger').click(function (e) {
                    $('.categories-list').toggle(
                        // function () { $('.categories-list').css("display", "block")},
                        // function () { $('.categories-list').css("display", "none")},
                    );
                    console.log('trigger');
                    e.stopPropagation();
                    return false;
                });
                $(document).on("click", function () {
                    if ($('.categories-list').css("display") === "block") {
                        $('.categories-list').css("display", "none");
                    }
                });
            }

            var sorter = '';
            $('#sorter').change(function() {
                sorter = $('#sorter option:selected').val() ? $('#sorter option:selected').val() : '';
                console.log(sorter)
                window.location.href = $('#sorter').val();
            });

        });

    </script>
@endsection


