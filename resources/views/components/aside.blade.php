<div class="flex items-stretch gap-2">
    <div itemscope itemtype="https://schema.org/ItemList" class="w-1/2 bg-base-100 rounded-md p-3 space-y-2">
        <meta itemprop="name" content="أحدث المتاجر" />
        <meta itemprop="itemListOrder" content="https://schema.org/ItemListOrderDescending" />
        <meta itemprop="numberOfItems" content="5" />
        <h2 class="my-1 text-center font-bold text-accent">أحدث المتاجر</h2>
        <p>
            <ul class="flex-center-col gap-2">
                @foreach($latest as $index => $item)
                    <li itemscope itemtype="https://schema.org/Organization" itemprop="itemListElement" class="w-full">
                        <meta itemprop="position" content="{{$index}}" />
                        <a aria-label="{{$item->_store_name}}" itemprop="url" class="block bg-accent text-center font-medium w-full rounded-md text-accent-content p-1" href="/coupons/{{$item->_store_param===null?$item->_store_name:$item->_store_param}}">
                            {{$item->_store_name}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </p>
    </div>
    <div itemscope itemtype="https://schema.org/ItemList" class="w-1/2 bg-base-100 rounded-md p-3 space-y-2">
        <meta itemprop="name" content="اشهر المتاجر" />
        <meta itemprop="itemListOrder" content="https://schema.org/ItemListOrderDescending" />
        <meta itemprop="numberOfItems" content="5" />
        <h2 class="my-1 text-center font-bold text-accent">اشهر المتاجر</h2>
        <p>
            <ul class="flex-center-col gap-2">
                @foreach($top as $item)
                    <li itemscope itemtype="https://schema.org/Organization" itemprop="itemListElement" class="w-full">
                        <meta itemprop="position" content="{{$index}}" />
                        <a aria-label="{{$item->_store_name}}" itemprop="url" class="block bg-accent text-center font-medium w-full rounded-md text-accent-content p-1" href="/coupons/{{$item->_store_param===null?$item->_store_name:$item->_store_param}}">
                            {{$item->_store_name}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </p>
    </div>
</div>