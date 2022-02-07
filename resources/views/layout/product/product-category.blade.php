@extends('app')

@section('page.title', $title.': '.$page_title->category)

@section('content')
    <section id="categories">
        @include('layout.partial.category-title')
        <div class="categories-list">
            <ul class="for-him">
                @foreach( $categories as $category)
                    @if( $id == 1)
                        <li>
                            <a href="{{ route('for-him.category', ['cat' => $category->categoryvi]) }}">{{ $category->category }}</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('for-her.category', ['cat' => $category->categoryvi]) }}">{{ $category->category }}</a>
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
                        @if( $id ==1 )
                            <option value="{{ route('for-him.category', ['cat' => $cat,'sorter' => 1]) }}">Thứ tự chữ
                                cái A-Z
                            </option>
                            <option value="{{ route('for-him.category', ['cat' => $cat,'sorter' => 2]) }}">Thứ tự chữ
                                cái Z-A
                            </option>
                            <option value="{{ route('for-him.category', ['cat' => $cat,'sorter' => 3]) }}">Giá tăng
                                dần
                            </option>
                            <option value="{{ route('for-him.category', ['cat' => $cat,'sorter' => 4]) }}">Giá giảm
                                dần
                            </option>
                            <option value="{{ route('for-him.category', ['cat' => $cat,'sorter' => 5]) }}">Sản phẩm mới
                                nhất
                            </option>
                        @else
                            <option value="{{ route('for-her.category', ['cat' => $cat,'sorter' => 1]) }}">Thứ tự chữ
                                cái A-Z
                            </option>
                            <option value="{{ route('for-her.category', ['cat' => $cat,'sorter' => 2]) }}">Thứ tự chữ
                                cái Z-A
                            </option>
                            <option value="{{ route('for-her.category', ['cat' => $cat,'sorter' => 3]) }}">Giá tăng
                                dần
                            </option>
                            <option value="{{ route('for-her.category', ['cat' => $cat,'sorter' => 4]) }}">Giá giảm
                                dần
                            </option>
                            <option value="{{ route('for-her.category', ['cat' => $cat,'sorter' => 5]) }}">Sản phẩm mới
                                nhất
                            </option>
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
    <script type="text/javascript" src="{{ asset('js/product.js') }}"></script>
@endsection


