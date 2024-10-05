<div id="card_{{$id}}_p" class="flex flex-col items-center shadow-md shadow-black/30 rounded-md bg-base-100 space-y-2" itemscope itemtype="https://schema.org/Offer">
    <div style="background:{{$image?'url('.$image.')':''}}; background-size:cover; background-position:center;aspect-ratio: 800 / 400;" class="w-full border-accent border-[3px] border-r-[7px] bg-primary max-h-[400px] max-w-[800px]"></div>
    <div class="p-2 pr-4 w-full flex flex-col justify-between h-full">
        <div class="w-full space-y-2">
            <span class="text-gray-600 font-bold opacity-50">تاريخ انشر : {{ParseDateIntoArabic($created)}}</span>
            <span itemprop="price" content="{{$value}}" class='badge badge-primary font-bold mx-2'>خصم {{$value}}%</span>
            <h3 itemprop="name" class="text-lg font-bold">{{$title}}</h3>
        </div>
        <p itemprop="description" id="desc_{{$id}}" class="hidd w-full text-lg py-2">@php echo $desc @endphp</p>
        <div class="w-full mt-2 flex flex-wrap justify-between items-center gap-2">
            <h4 onclick="showMore({{$id}})" class="md:pb-4 relative z-10 md:pt-1 cursor-pointer w-fit flex gap-1 md:pr-4 pr-1 text-accent">
                <span id="show_more_{{$id}}">
                    عرض التفاصيل 
                </span>
                <x-tabler-chevron-down id="show_icon_{{$id}}" class="rotate-0"/>
            </h4>
            <link itemprop="availability" href="https://schema.org/InStock" />
            <div class="flex flex-wrap gap-2 p-2 md:w-auto w-full justify-center">
                @if(isset($store)&&$store)
                    <a aria-label="كود خصم اضافي" itemprop="url" href="/coupons/{{$store}}" class="btn btn-sm text-lg px-4 h-[2em] font-bold btn-accent z-10 rounded-full">كود خصم اضافي</a>
                @endif
                @if(isset($link)&&$link)
                    <a aria-label="زيارة العرض" itemprop="url" target="_blank" href="{{$link}}" class="btn btn-sm text-lg px-4 h-[2em] font-bold btn-accent z-10 rounded-full">زيارة العرض</a>
                @endif
            </div>
        </div>
    </div>
</div>