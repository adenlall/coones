@isset($items)
<div class="breadcrumbs text-sm p-0 pt-2 overflow-hidden">
  <ul>
      @foreach($items as $index => $item)
          @if(isset($item['path']))
              <li><a href="{{$item['path']}}">{{$item['name']}}</a></li>
          @else
            <li>{{$item['name']}}</li>
          @endif
      @endforeach
  </ul>
</div>
@endisset
