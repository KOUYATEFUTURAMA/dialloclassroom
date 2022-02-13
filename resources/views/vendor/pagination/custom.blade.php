@if ($paginator->hasPages())       
        @if ($paginator->onFirstPage())
            
        @else
            <a href="{{ $paginator->previousPageUrl() }}">← Pr&eacute;c&eacute;dent</a>
        @endif

        @foreach ($elements as $element)
           
            @if (is_string($element))
                <a>{{ $element }}</a>
            @endif
           
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="current-page">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
        
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">Suivant →</a>
        @else
     
        @endif
   
@endif 