<div id="card_{{$id}}_p" class="flex flex-col justify-between items-center shadow-md shadow-black/30 rounded-md bg-base-100 p-3 space-y-2 w-full">
    <div class="w-full space-y-2">
        <div class="flex flex-row items-center justify-between w-full">
            <a href="{{'/store/'.$store->_store_name}}"><img class="w-[110px] h-[58px] rounded-md" src="{{$store->thumbnail}}"/></a>
            <div class="flex-center-row gap-2" onclick="{{'share_modal_'.$id.'_o'}}.showModal()" >
                <x-tabler-share class="hover:bg-base-200/80 rounded-full h-8 w-8 p-1 cursor-pointer" />
            </div>
        </div>
        <hr class="border-base-content/30 w-full"/>
    </div>
    <x-coupon-modal :store="$store" :link="$link" :id="$id" :title="$title" :desc="$desc" :code="$code" />
    <x-share-modal :id="$id" :title="$title" :url="urlencode('http://localhost/store/'.$store->_store_name)" />
    <p class="w-full text-sm">{{ParseDateIntoArabic($created)}}</p>
    <h2 class="text-xl text-right w-full h-full">{{$title}}</h2>
    <hr class="border-base-content/30 w-full"/>
    <div class="flex justify-between items-center w-full">
        <p onclick="showMore({{$id}})" id="show_more_{{$id}}" class="text-sm underline cursor-pointer underline-offset-2">عرض المزيد</p>
        <a href="/store/{{$store->_store_name}}"><p class="text-sm underline underline-offset-2">زيارة المتجر</p></a>
    </div>
    <p id="desc_{{$id}}" class="hidd">@php echo $desc @endphp</p>
    <div class="w-full space-y-2">
        <div class="w-full" dir="ltr">
            @if($type==="3" && isset($link))
                <a href="{{$link}}" target="_blank" class="btn btn-accent h-[3rem] font-bold text-xl rounded-md min-h-min w-full">
                    الحصول على العرض
                </a>
            @elseif($type==="1" && isset($link))
                <div onclick="function openmodaland(){
                    window.location.href = '{{$link}}';
                    window.open('{{url()->current()}}?modal={{$id}}#card_{{$id}}_p', '_blank');
                }
                openmodaland();" class="inline-flex w-full items-center group">
                    <div class="relative overflow-hidden">
                        <div class="bg-gray-100 border-[3px] border-dotted border-r-0 border-gray-400 text-gray-700 px-3 py-[.55rem] text-xl rounded-l-md">
                            {{ $code ? str_split($code, 3)[0] : '' }}
                        </div>
                    </div>
                    <button
                        class="bg-accent w-[130%] text-white text-xl py-3 px-4 font-bold rounded-r-md transition-colors duration-200 relative z-10"
                        aria-label="عرض الكوبون AZ"
                    >
                        عرض الكوبون
                    </button>
                </div>
            @else
                <div onclick="{{'coupon_modal_'.$id.'_o'}}.showModal();"  class="inline-flex w-full items-center group">
                    <div class="relative overflow-hidden">
                        <div class="bg-gray-100 border-[3px] border-dotted border-r-0 border-gray-400 text-gray-700 px-3 py-[.55rem] font-medium text-xl rounded-l-md">
                            {{ $code ? str_split($code, 3)[0] : '' }}
                        </div>
                    </div>
                    <button
                        class="bg-accent w-[130%] text-white text-xl py-3 px-4 font-bold rounded-r-md transition-colors duration-200 relative z-10"
                        aria-label="عرض الكوبون AZ"
                    >
                        عرض الكوبون
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
