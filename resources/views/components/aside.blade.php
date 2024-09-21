<div class="flex items-stretch gap-2">
    <div class="w-1/2 bg-base-100 rounded-md p-3 space-y-2">
        <h4 class="my-1 text-center font-bold text-accent">أحدث المتاجر</h4>
        <p>
            <ul class="flex-center-col gap-2">
                @foreach($latest as $item)
                    <li class="w-full">
                        <a class="block bg-accent text-center font-medium w-full rounded-md text-accent-content p-1" href="/store/{{$item->_store_name}}">
                            {{$item->_store_name}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </p>
    </div>
    <div class="w-1/2 bg-base-100 rounded-md p-3 space-y-2">
        <h4 class="my-1 text-center font-bold text-accent">اشهر المتاجر</h4>
        <p>
            <ul class="flex-center-col gap-2">
                @foreach($top as $item)
                    <li class="w-full">
                        <a class="block bg-accent text-center font-medium w-full rounded-md text-accent-content p-1" href="/store/{{$item->_store_name}}">
                            {{$item->_store_name}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </p>
    </div>
</div>