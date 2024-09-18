@if ($paginator->hasPages())
    <div class="w-full text-center bg-base-200 rounded-lg flex-row-center gap-4">
        {{-- Previous Page Link --}}
        @if (! $paginator->onFirstPage())
            <a class="btn btn-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; السابق</a>
        @else
            <a class="btn btn-disabled" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; السابق</a>
        @endif

        {{-- Numbered Page Links --}}
        @foreach ($paginator as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="active btn btn-primary">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="btn btn-primary" href="{{ $paginator->nextPageUrl() }}" rel="next">التالي &raquo;</a>
        @else
            <a class="btn btn-disabled" href="{{ $paginator->nextPageUrl() }}" rel="next">التالي &raquo;</a>
        @endif
    </div>
@endif