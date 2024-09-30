@isset($items)
<nav aria-label="Breadcrumb" class="breadcrumbs text-sm p-0 pt-2 mt-3 overflow-hidden">
  <ol itemscope itemtype="https://schema.org/BreadcrumbList">
      @foreach($items as $index => $item)
          @if(isset($item['path']))
              <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" aria-label="{{$item['path']}}" href="{{$item['path']}}">
                  <span itemprop="name">
                    {{$item['name']}}
                  </span>
                </a>
                <meta itemprop="position" content="{{$index+1}}" />
              </li>
          @else
            <li>{{$item['name']}}</li>
          @endif
      @endforeach
  </ol>
</nav>
@endisset
