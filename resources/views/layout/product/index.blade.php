@extends('app')

@section('page.title', $page_title)

@section('content')
    <section id="categories">
        @include('layout.partial.category-title')
        <div class="categories-list">
            <ul class="for-him">
                @foreach( $categories as $category)
                    @if( $id == 0)
                        <li>
                            <a href="{{ route('for-her.category', ['cat' => $category->categoryvi]) }}">{{ $category->category }}</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('for-him.category', ['cat' => $category->categoryvi]) }}">{{ $category->category }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="categories-filter">
            <div class="toolbar-sorter">
                <div class="form-item-select">
                    <select id="sorter" data-role="sorter" class="sorter-option">
                        <option value="0" disabled hidden selected>Sắp xếp theo</option>
                        @if( $id == 0)
                            <option value="{{ route('for-her.index', ['sorter' => 1]) }}">Thứ tự chữ cái A-Z</option>
                            <option value="{{ route('for-her.index', ['sorter' => 2]) }}">Thứ tự chữ cái Z-A</option>
                            <option value="{{ route('for-her.index', ['sorter' => 3]) }}">Giá tăng dần</option>
                            <option value="{{ route('for-her.index', ['sorter' => 4]) }}">Giá giảm dần</option>
                            <option value="{{ route('for-her.index', ['sorter' => 5]) }}">Sản phẩm mới nhất</option>
                        @else
                            <option value="{{ route('for-him.index', ['sorter' => 1]) }}">Thứ tự chữ cái A-Z</option>
                            <option value="{{ route('for-him.index', ['sorter' => 2]) }}">Thứ tự chữ cái Z-A</option>
                            <option value="{{ route('for-him.index', ['sorter' => 3]) }}">Giá tăng dần</option>
                            <option value="{{ route('for-him.index', ['sorter' => 4]) }}">Giá giảm dần</option>
                            <option value="{{ route('for-him.index', ['sorter' => 5]) }}">Sản phẩm mới nhất</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="filter-list" id="trigger">
                <div>
                   <span class="list-trigger" style="z-index: 99;text-transform: capitalize; cursor: pointer;">{{ $slug }} <i class="ti-angle-down" style="font-size: 12px"></i></span>
                </div>
            </div>
        </div>
        <div class="categories-product">
            <ul class="product-list">
                @foreach( $products as $product)
                    <li>
                        <div class="product">
                            <div class="thumnail">
                                <a href="{{ route('product.detail', ['product' => $product->namevi]) }}"><span style="background-image:url( {{ $product->image }})" alt=""></span></a>
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
            // var length = $('.for-him a').length;
            // for (let i = 1; i <= length; i++) {
            //     if ($('ul li:nth-child(' + i + ')').length > 0) {
            //
            //         $('ul li:nth-child(' + i + ')').click(function () {
            //             $('.active').removeClass('active');
            //             $('ul li:nth-child(' + i + ')').addClass('active');
            //             category = $('.for-him .active a').text();
            //         });
            //     }
            // }

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
            // $('.for-him').click(function() {
            //     console.log(category, "category")  ;
            //     $.ajax({
            {{--        url: "{{ route('for-him.list') }}",--}}
            //         method: "post",
            //         data: {
            //             '_token': csrf,
            //             'category': category,
            //             'page' : page,
            //         },
            //         success: function (data) {
            //             if (data.success) {
            //                 $('.product-list li').remove();
            //                 $('.product-list').append(data.html);
            //             }
            //         },
            //     });
            // });
            // $.ajax({
            {{--    url:"{{ route('for-him.list') }}",--}}
            //     method: "post",
            //     data: {
            //         '_token' : csrf,
            //         'page' : page,
            //     },
            //     success: function(data) {
            //         if(data.success) {
            //             console.log('sort', sorter)
            //             $('.product-list').append(data.html);
            //         }
            //     },
            // });
        });

    </script>
@endsection


