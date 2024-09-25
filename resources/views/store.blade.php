<x-layout>
    <x-slot:title>
        الصفحة الرئيسية
    </x-slot>
    <div class="m-auto w-full">
        <div class="w-full md:px-0 px-2 bg-base-100 pt-2 pb-4">
            <div class="w-full ccontainer m-auto">
                <x-breadcrumbs :items="[['name'=>'الرئيسية', 'path'=>'/'],['name'=>'جميع المتاجر', 'path'=>'/store'],['name'=>$store->_store_name]]"/>
                <div class="flex gap-6 md:flex-row flex-col justify-center items-end mt-2 mb-4">
                    <div class="md:min-w-[135px] mx-1 min-w-full space-y-2">
                        <img class="w-[135px] h-[68px] md:m-0 m-auto rounded-md" src="{{$store->thumbnail}}"/>
                        <button onclick="window.location.href='/store/{{$store->_store_name}}'" class="btn btn-sm text-md btn-accent btn-block">زيارة المتجر</button>
                    </div>
                    <div class="w-full h-full">
                        <h1 class="text-3xl font-medium mb-1">{{$store->title}}</h1>
                        <div class="flex md:flex-row flex-col mb-4">
                            <p>أخر تحديث: {{getCurrentMonthInArabic()}} {{date("Y")}}</p>
                            <div class="flex items-center">
                                <div class="rating rating-half mr-1">
                                    <input disabled onclick="ratefromstore('0')" type="radio" name="rating-10" class="mask mask-star-2 bg-primary p-[.55rem] cursor-default" {{$rate>=0?'checked':''}} />
                                    <input disabled onclick="ratefromstore('0')" type="radio" name="rating-10" class="mask mask-star-2 bg-primary p-[.55rem] cursor-default" {{$rate>=1?'checked':''}} />
                                    <input disabled onclick="ratefromstore('1')" type="radio" name="rating-10" class="mask mask-star-2 bg-primary p-[.55rem] cursor-default" {{$rate>=2?'checked':''}} />
                                    <input disabled onclick="ratefromstore('1')" type="radio" name="rating-10" class="mask mask-star-2 bg-primary p-[.55rem] cursor-default" {{$rate>=3?'checked':''}} />
                                    <input disabled onclick="ratefromstore('1')" type="radio" name="rating-10" class="mask mask-star-2 bg-primary p-[.55rem] cursor-default" {{$rate>=4?'checked':''}} />
                                </div>
                                <span class="mr-1">
                                    {{$rate}} / 5
                                </span>
                                <span class="mr-1" id="totale-rates">
                                    {{"("}} {{$totalrate+((int)$store->_store_stars)}} تقييم {{")"}}
                                </span>
                            </div>
                        </div>
                        <p>
                            {{$store->_store_description}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="ccontainer w-full flex items-start flex-col-reverse md:flex-row-reverse gap-5 p-4" style="padding-top:20px;">
            <div class="w-full md:w-[22em]">
                <x-aside/>
            </div>
            <div class="w-full md:w-[800px]">
                @if(count($coupons))
                    <ul class="flex-center-col gap-4 mb-4">
                    @foreach($coupons as $coupon)
                        <div class="w-full border-accent border-r-[5px] border-2 rounded-md bg-base-100">
                            <x-coupon-modal :store="$store" :link="$coupon->_ncoupon_link" :id="$coupon->ID" :title="$coupon->title" :desc="$coupon->_ncoupon_desc" :code="$coupon->_ncoupon_code" />
                            <div class="flex md:flex-row flex-col justify-between items-start gap-3 md:p-8 md:pl-5">
                                <h3 class="font-bold text-md md:p-0 p-3">{{$coupon->title}}</h3>
                                <div class="md:w-auto w-full md:p-0 px-3" dir="ltr">
                                    @if($coupon->_ncoupon_type==="3")
                                        <a href="{{$coupon->_ncoupon_link}}" target="_blank" class="btn btn-accent h-[3rem] font-bold text-xl rounded-md min-h-min w-full">
                                            الحصول على العرض
                                        </a>
                                    @elseif($coupon->_ncoupon_type==="1")
                                        <div onclick="function openmodaland(){
                                            window.location.href = '{{$coupon->_ncoupon_link}}';
                                            window.open('{{url()->current()}}?modal={{$coupon->ID}}#card_{{$coupon->ID}}_p', '_blank');
                                        }
                                        openmodaland();" class="inline-flex w-full items-center group">
                                            <div class="relative overflow-hidden">
                                                <div class="bg-gray-100 border-[3px] border-r-0 border-accent text-gray-700 px-3 py-[.55rem] text-xl rounded-l-md">
                                                    {{ $coupon->_ncoupon_code ? str_split($coupon->_ncoupon_code, 3)[0] : '' }}
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
                                        <div onclick="{{'coupon_modal_'.$coupon->ID.'_o'}}.showModal();"  class="inline-flex w-full items-center group">
                                            <div class="relative overflow-hidden">
                                                <div class="bg-gray-100 border-[3px] border-r-0 border-accent text-gray-700 px-3 py-[.55rem] font-medium text-xl rounded-l-md">
                                                    {{ $coupon->_ncoupon_code ? str_split($coupon->_ncoupon_code, 3)[0] : '' }}
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
                            <hr class="mb-2"/>
                            <p id="desc_{{$coupon->ID}}" class="hidd text-lg px-2">
                                @php echo $coupon->content @endphp
                            </p>
                            <div>
                                <h5 onclick="showMore({{$coupon->ID}})" class="pb-4 relative z-10 pt-1 cursor-pointer w-fit flex gap-1 pr-4 text-accent">
                                    <span id="show_more_{{$coupon->ID}}">
                                       عرض التفاصيل 
                                    </span>
                                    <x-tabler-chevron-down id="show_icon_{{$coupon->ID}}" class="rotate-0"/>
                                </h5>
                            </div>
                        </div>
                    @endforeach
                    </ul>
                @endif
                <x-paginator :paginator="$coupons" />
                <div class="w-full">
                    <div class="prose-md">
                        @php
                            $content = $store->content;
                            $parsed = str_replace('$$$', '<div style="width:calc(100% + 16px); margin-right:-8px;" class="separator w-full bg-base-200 p-2 my-2"></div>', $content);
                        @endphp
                        <div class="bg-base-100 mb-4 p-2 rounded-md">
                            @php echo $parsed @endphp
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        function checkisrated(force){
            if (!sessionStorage.getItem('{{$store->_store_name}}') || force) {
                const stars = document.querySelectorAll('.mask-star-2');
                for (const element of stars) {
                    element.disabled = false;
                    element.classList.remove('cursor-default');
                }
            }else{
                const stars = document.querySelectorAll('.mask-star-2');
                for (const element of stars) {
                    element.disabled = true;
                    element.classList.add('cursor-default');
                }
            }
        }checkisrated();
        async function ratefromstore(review) {
            console.log('revvv:: '+review);
            await postReview({storeName:'{{$store->_store_name}}',fingerprint:'{{\Illuminate\Support\Str::random(25)}}', review:review, couponId:''})
            sessionStorage.setItem('{{$store->_store_name}}', review);
            document.querySelector('#totale-rates').innerText = '( {{$totalrate+((int)$store->_store_stars)+1}} تقييم )';
            checkisrated();
        }
        function showMore(id) {
            var desc = document.getElementById('desc_' + id);
            var icon = document.getElementById('show_icon_' + id);
            desc.classList.toggle('viss');
            desc.classList.toggle('hidd');
            icon.classList.toggle('rotate-0');
            icon.classList.toggle('rotate-180');
            if (desc.classList.contains('viss')) {
                document.getElementById('show_more_' + id).innerText = 'اخفاء التفاصيل';
            } else {
                document.getElementById('show_more_' + id).innerText = 'عرض التفاصيل';
            }
        }
    </script>
    @endpush
</x-layout>
