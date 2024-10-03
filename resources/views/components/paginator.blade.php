@if ($paginator->hasPages())
<nav aria-label="Pagination" class="flex justify-center mt-8">
    <div class="">
        @php
            $currentPage = $paginator->currentPage();
            $lastPage = $paginator->lastPage();
            $delta = 1; // Number of pages to show on each side of the current page
        @endphp
        <a href="{{ $paginator->url(1) }}" class="btn rounded-md {{ $currentPage == 1 ? 'btn-primary' : 'bg-base-100' }}">
            1
        </a>
        @if($currentPage > $delta + 2)
            <button class="btn rounded-md btn-disabled text-[gray!important] bg-[white!important]">...</button>
        @endif
        @foreach (range(max(2, $currentPage - $delta), min($lastPage - 1, $currentPage + $delta)) as $page)
            <a href="{{ $paginator->url($page) }}" class="btn rounded-md {{ $currentPage == $page ? 'btn-primary' : 'bg-base-100' }}">
                {{ $page }}
            </a>
        @endforeach
        @if($currentPage < $lastPage - $delta - 1)
            <button class="btn rounded-md btn-disabled text-[gray!important] bg-[white!important]">...</button>
        @endif
        @if($lastPage > 1)
            <a href="{{ $paginator->url($lastPage) }}" class="btn rounded-md {{ $currentPage == $lastPage ? 'btn-primary' : 'bg-base-100' }}">
                {{ $lastPage }}
            </a>
        @endif
    </div>
</nav>
@endif