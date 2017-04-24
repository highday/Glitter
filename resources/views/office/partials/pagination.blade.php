@if ($paginator->hasPages())
<nav aria-label="Pagination Navigation">
    <ul class="pagination mb-0 ">
@if ($paginator->onFirstPage())
        <li class="page-item disabled"><span class="page-link"><i class="fa fa-fw fa-angle-double-left"></i></span></li>
@else
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-fw fa-angle-double-left"></i></a></li>
@endif
@foreach ($elements as $element)
@if (is_string($element))
        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
@endif
@if (is_array($element))
@foreach ($element as $page => $url)
@if ($page == $paginator->currentPage())
        <li class="page-item active"><span class="page-link">{{ $page }} <span class="sr-only">(current)</span></span></li>
@else
        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
@endif
@endforeach
@endif
@endforeach
@if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-fw fa-angle-double-right"></i></a></li>
@else
        <li class="page-item disabled"><span class="page-link"><i class="fa fa-fw fa-angle-double-right"></i></span></li>
@endif
    </ul>
</nav>
@endif
