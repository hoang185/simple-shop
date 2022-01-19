
@if ($paginator->hasPages())
    <nav style="padding: 0 5%">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" style=" border-style: hidden;color: #000" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">
                                                <i class="ti-arrow-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" style="margin-top: 2px ; border-style: hidden;color: #000" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="ti-arrow-left"></i>
                    </a>

                </li>
            @endif
            <style>
                .pagination .page-item .page-link:focus {
                    line-height: 1;
                    box-shadow: none;
                }
            </style>

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"  aria-current="page"><span class="page-link" style="background-color: #ddd;color: black; border-color: transparent; outline: none">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" style="color: #707070;border-style: hidden; outline: none" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" style="margin-top: 2px ;border-style: hidden;color: #000" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="ti-arrow-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
