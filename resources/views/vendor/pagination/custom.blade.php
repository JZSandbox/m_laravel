
@if ($paginator->hasPages())
<ul class="pagination acht-pagination">

    @if ($paginator->onFirstPage())
        <li class="acht-pagination-prev disabeld prev-before"><span class="material-icons">arrow_back_ios</span></li>
    @else
        <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="acht-pagination-prev link"><span class="material-icons">arrow_back_ios</span></a></li>
    @endif



    @foreach ($elements as $element)

        @if (is_string($element))
            <li class="disabled"><span>{{ $element }}</span></li>
        @endif



        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="acht-pagination page active"><span>{{ $page }}</span></li>
                @else
                    <li><a href="{{ $url }}" class="acht-pagination page link">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach



    @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" class="acht-pagination-next link page-next"><span class="material-icons">arrow_forward_ios</span></a></li>
    @else
        <li class="acht-pagination disabeld"><span class="material-icons">arrow_forward_ios</span></li>
    @endif
</ul>
@endif
