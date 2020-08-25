@if ($paginator->hasPages())
        {{-- Previous Page Link --}}
            <!-- <li class="page-number color_b1n"><a href="#" class="color_t1n">|&lt;</a></li> -->
            <li class="page-number color_b1n"><a class="icon item disabled color_t1n" aria-disabled="true" aria-label="@lang('pagination.previous')">|&lt;</a></li>

            <li class="page-number color_b1n"><a class="icon item color_t1n" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lt;</a></li>

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-number color_b1n"><a class="icon item disabled color_t1n" aria-disabled="true">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-number color_b1n"><a class="item active color_t1n" href="{{ $url }}" aria-current="page">{{ $page }}</a></li>
                    @else
                        <li class="page-number color_b1n"><a class="item color_t1n" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
            <li class="page-number color_b1n"><a class="icon item color_t1n" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&gt;</a></li>
            <li class="page-number color_b1n"><a class="icon item disabled color_t1n" aria-disabled="true" aria-label="@lang('pagination.next')">&gt;|</a></li>
@endif
