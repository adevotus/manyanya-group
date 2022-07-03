@if ($paginator->hasPages())
    <ul class="pagination pagination-rounded justify-content-end mb-0">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        @else
            <li class="page-item">
                <a class="page-link"
                    href="{{ $paginator->previousPageUrl() . '&search=' . request()->get('search') . '&' . 'date=' . request()->get('date') }}"
                    rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled page-item" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active page-item" aria-current="page"><a href="#"
                                class="page-link">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link"
                                href="{{ $url . '&search=' . request()->get('search') . '&' . 'date=' . request()->get('date') }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link"
                    href="{{ $paginator->nextPageUrl() . '&search=' . request()->get('search') . '&' . 'date=' . request()->get('date') }}"
                    rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @endif
    </ul>
@endif
