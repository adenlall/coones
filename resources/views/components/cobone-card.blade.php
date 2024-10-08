<li id="card_{{$id}}_p" class="shadow-md shadow-black/30 rounded-md bg-base-100 w-full">
    <div class="flex flex-col justify-between items-center p-3 space-y-2 w-full h-full">
        <div class="w-full space-y-2">
            <div class="flex flex-row items-center justify-between w-full">
                <meta content="متجر {{$store->_store_name}}" />
                <meta content="{{'https://coupon3sari3.com/coupons/'.$store->_store_name}}" />
                <a aria-label="زيارة العرض" href="{{'/coupons/'.($store->_store_param===null?$store->_store_name:$store->_store_param)}}">
                    <img class="w-[135px] h-[68px] rounded-md" alt="شعار متجر {{$store->_store_name}}" src="{{$store->thumbnail}}"/>
                </a>
                <div class="flex-center-row gap-2" onclick="{{'share_modal_'.$id.'_o'}}.showModal()" >
                    <x-tabler-share class="hover:bg-base-200/80 rounded-full h-8 w-8 p-1 cursor-pointer" />
                </div>
            </div>
            <hr class="border-base-content/30 w-full"/>
        </div>
        <x-coupon-modal :store="$store" :link="$link" :id="$id" :title="$title" :desc="$desc" :code="$code" />
        <x-share-modal :id="$id" :title="$title" :url="urlencode('https://coupon3sari3.com/coupons/'.($store->_store_param===null?$store->_store_name:$store->_store_param))" />
        <h3 class="text-xl text-right w-full h-full">{{$title}}</h3>
        <hr class="border-base-content/30 w-full"/>
        <div class="w-[100%] space-y-2">
            <a aria-label="{{$store->_store_name}}" href="/coupons/{{$store->_store_param===null?$store->_store_name:$store->_store_param}}" class="btn rounded-sm btn-sm btn-ghost font-bold text-lg w-full mt-3">عرض جميع الكوبونات</a>
            <div class="w-full" dir="ltr">
                @if($type==="3" && isset($link))
                    <a aria-label="الحصول على العرض" href="{{$link}}" target="_blank" class="btn btn-accent h-[3rem] font-bold text-xl rounded-md min-h-min w-full">
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
</li>
