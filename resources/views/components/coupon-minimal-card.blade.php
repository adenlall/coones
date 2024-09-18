<div id="card_{{$id}}_p" class="flex flex-col items-center shadow-md shadow-black/30 rounded-md bg-base-100 space-y-2 w-full lg:w-[860px]">
    <div style="background:{{$image?'url('.$image.')':''}}; background-size:cover;" class="w-full min-h-[14em] lg:min-h-[318px] border-accent border-[3px] border-r-[7px] bg-primary"></div>
    <div class="p-2 pr-4 w-full flex flex-col justify-between h-full">
        <div class="w-full space-y-2">
            <span>تاريخ انشر : {{ParseDateIntoArabic($created)}}</span>
            @if(app('request')->input('sort') === 'top')
                <span class='badge badge-primary mx-2'>خصم {{$value}}%</span>
            @endif
            <h3 class="text-lg font-bold">{{$title}}</h3>
        </div>
        <p id="desc_{{$id}}" class="hidd w-full text-lg indent-4 py-2">@php echo $desc @endphp</p>
        <div class="w-full mt-2 flex flex-wrap justify-between items-center gap-2">
            <h5 onclick="showMore({{$id}})" class="pb-4 relative z-10 pt-1 cursor-pointer w-fit flex gap-1 pr-4 text-accent">
                <span id="show_more_{{$id}}">
                    تفاصيل العرض 
                </span>
                <x-tabler-chevron-down id="show_icon_{{$id}}" class="rotate-0"/>
            </h5>
            <div class="flex flex-wrap gap-2 p-2">
                <a href="/store/{{$store->_store_name}}" class="btn btn-sm text-lg font-bold btn-accent rounded-full">كود خصم اضافي</a>
                @isset($link)
                    <a target="_blank" href="{{$link}}" class="btn btn-sm text-lg font-bold btn-accent rounded-full">زيارة العرض</a>
                @endisset
            </div>
        </div>
    </div>
</div>