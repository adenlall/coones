@if ($paginator->hasPages())
<nav aria-label="Pagination" class="flex justify-center mt-8">
    <div class="">
        @php
            $currentPage = $paginator->currentPage();
            $lastPage = $paginator->lastPage();
            $delta = 1; // Number of pages to show on each side of the current page
        @endphp

        <!-- Always show the first page link -->
        <a href="{{ $paginator->url(1) }}" class="btn rounded-md {{ $currentPage == 1 ? 'btn-primary' : 'bg-base-100' }}">
            1
        </a>

        <!-- Show ellipsis if there are more than two pages and current page is far enough from the start -->
        @if($currentPage > $delta + 2 && $lastPage > 3)
            <button class="btn rounded-md btn-disabled text-[gray!important] bg-[white!important]">...</button>
        @endif

        <!-- Display page links around the current page -->
        @foreach (range(max(2, $currentPage - $delta), min($lastPage - 1, $currentPage + $delta)) as $page)
            @if ($page > 1 && $page < $lastPage) <!-- Ensure we don't show first or last page in this loop -->
                <a href="{{ $paginator->url($page) }}" class="btn rounded-md {{ $currentPage == $page ? 'btn-primary' : 'bg-base-100' }}">
                    {{ $page }}
                </a>
            @endif
        @endforeach

        <!-- Show ellipsis if there are more than two pages and current page is far enough from the end -->
        @if($currentPage < $lastPage - $delta - 1 && $lastPage > 3)
            <button class="btn rounded-md btn-disabled text-[gray!important] bg-[white!important]">...</button>
        @endif

        <!-- Always show the last page link if there's more than one page -->
        @if($lastPage > 1)
            <a href="{{ $paginator->url($lastPage) }}" class="btn rounded-md {{ $currentPage == $lastPage ? 'btn-primary' : 'bg-base-100' }}">
                {{ $lastPage }}
            </a>
        @endif
    </div>
</nav>
@endif
