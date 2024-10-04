@isset($items)
<nav class="breadcrumbs text-sm p-0 pt-2 mt-3 overflow-hidden">
  <ol>
      @foreach($items as $index => $item)
          @if(isset($item['path']))
              <li>
                <a aria-label="{{$item['path']}}" href="{{$item['path']}}">
                  <span>
                    {{$item['name']}}
                  </span>
                </a>
              </li>
          @else
            <li>{{$item['name']}}</li>
          @endif
      @endforeach
  </ol>
</nav>
@endisset
