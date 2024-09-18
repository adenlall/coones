<x-layout>
    <x-slot:title>
        الصفحة الرئيسية
    </x-slot>

    <div class="bg-base-100 pb-6">
        <div class="w-full lg:px-10 lg:container m-auto flex items-center justify-center gap-2 lg:gap-6 p-4">
            <x-carousel/>
            <div class="bg-base-300 w-[20em] h-[20em] rounded-box hidden lg:flex justify-center items-center">
                <span>Ad Space</span>
            </div>
        </div>
        <div class="w-full flex justify-center items-center lg:px-10 lg:container m-auto">
            <hr class="h-2 border-gray-400 w-1/3 mt-[6px]"/>
            <h1 class="text-lg w-full font-normal mx-8 outline text-center m-auto outline-1 p-1 rounded-full"><span class="">{{env('APP_NAME')}} - احدث كود خصم وكوبون فعال لكل المواقع</span></h1>
            <hr class="h-2 border-gray-400 w-1/3 mt-[6px]"/>
        </div>
    </div>

    <div class="lg:px-10 lg:container p-2 w-full m-auto my-4">
        <h2 class="text-3xl my-4">
            أحدث الكوبونات
        </h2>
        @if(count($paginated_coupons))
            <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 items-stretch justify-center gap-6">
                @foreach($paginated_coupons as $coupon)
                    <x-cobone-card
                        :id="$coupon->ID"
                        :title="$coupon->title"
                        :store="$coupon->store"
                        :desc="$coupon->_coupon_desc"
                        :type="$coupon->_coupon_type"
                        :link="$coupon->_coupon_link"
                        :code="$coupon->_coupon_code"
                    />
                @endforeach
            </ul>
        @else
            <div class="flex-center-col shadow-md bg-base-300 p-4 rounded-lg rounded-tr-none">
                <h5 class="text-xl font-bold p-2 py-4">لا يوجد كوبونات بعد</h5>
            </div>
        @endif
    </div>


    <div class="lg:px-10 lg:container p-2 w-full m-auto my-4">
        <h2 class="text-3xl my-4">
            الأسئلة الشائعة
        </h2>
        <ul class="flex-center-col shadow-md space-y-0 rounded-sm">
            <x-faq/>
        </ul>
    </div>

    <script>
        @if (app('request')->input('modal'))
            {{'coupon_modal_'.(app('request')->input('modal')).'_o'}}.showModal();
        @endif
    </script>

</x-layout>
