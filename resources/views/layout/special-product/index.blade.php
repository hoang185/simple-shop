@extends('app')

@section('page.title', $page_title)

@section('content')
    <section id="categories">
        @include('layout.partial.category-title')
        <div class="categories-filter">
            <div class="toolbar-sorter">
                <div class="form-item-select">
                    @if($page_title != SEARCH_RESULT)
                    <select id="sorter" data-role="sorter" class="sorter-option">
                        <option value="0" disabled hidden selected>Sắp xếp theo</option>
                        @if( $page_title == NEW_ARRIVAL)
                            <option value="{{ route('new-arrival.index', ['sorter' => 1]) }}">Thứ tự chữ cái A-Z</option>
                            <option value="{{ route('new-arrival.index', ['sorter' => 2]) }}">Thứ tự chữ cái Z-A</option>
                            <option value="{{ route('new-arrival.index', ['sorter' => 3]) }}">Giá tăng dần</option>
                            <option value="{{ route('new-arrival.index', ['sorter' => 4]) }}">Giá giảm dần</option>
                            <option value="{{ route('new-arrival.index', ['sorter' => 5]) }}">Sản phẩm mới nhất</option>
                        @elseif( $page_title == SALE_OFF)
                            <option value="{{ route('sale-off.index', ['sorter' => 1]) }}">Thứ tự chữ cái A-Z</option>
                            <option value="{{ route('sale-off.index', ['sorter' => 2]) }}">Thứ tự chữ cái Z-A</option>
                            <option value="{{ route('sale-off.index', ['sorter' => 3]) }}">Giá tăng dần</option>
                            <option value="{{ route('sale-off.index', ['sorter' => 4]) }}">Giá giảm dần</option>
                            <option value="{{ route('sale-off.index', ['sorter' => 5]) }}">Sản phẩm mới nhất</option>
                        @endif
                    </select>
                    @else
                    @endif
                </div>
            </div>
            <div class="filter-list" id="trigger">
                <div>
                    <span class="list-trigger" style="z-index: 99;text-transform: capitalize; cursor: pointer;margin-top: 2px">{{ $slug }} </span>
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
                                        @if($page_title == SALE_OFF)
                                            <div class="price">
                                                <p class="current">{{ number_format($product->price) }}&nbsp;đ</p>
                                                <p class="discount">{{ number_format($product->sale_price) }}&nbsp<span
                                                        class="currency-symbol">đ</span></p>
                                            </div>
                                        @else
                                            <div class="price">
                                                <p>{{ number_format($product->price) }}&nbsp;đ</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            @if( $page_title != SEARCH_RESULT)
            {{ $products->links('vendor.pagination.bootstrap-4') }}
            @else
            @endif
        </div>

    </section>
@endsection


