<x-layout>
    <div class="bg-base-100 pb-6" style="padding:20px 0px 20px 0px;">
        <div class="w-full ccontainer m-auto flex mb-[15px] items-center justify-center gap-2 lg:gap-6 p-4">
            <x-carousel/>
            <div class="bg-base-300 w-[16em] h-[315px] rounded-box hidden lg:flex justify-center items-center">
                <span>Ad Space</span>
            </div>
        </div>
        <div class="w-full flex justify-center items-center ccontainer m-auto">
            <hr class="md:block hidden h-2 border-gray-400 w-1/3 mt-[6px]"/>
            <h1 class="md:text-lg text-[11px] font-[700!important] w-full md:font-[400!important] md:mx-8 mx-0 outline text-center m-auto outline-1 p-1 rounded-full">
                كوبون على السريع - احدث كود خصم وكوبون فعال لكل المواقع
            </h1>
            <hr class="md:block hidden h-2 border-gray-400 w-1/3 mt-[6px]"/>
        </div>
    </div>

    <div class="ccontainer p-2 w-full full-width my-4">
        <h2 class="text-3xl my-4">
            أحدث الكوبونات
        </h2>
        @if(count($paginated_ncoupons))
            <ul itemscope itemtype="https://schema.org/ItemList" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 items-stretch justify-center gap-6">
                @foreach($paginated_ncoupons as $index => $ncoupon)
                    <x-cobone-card
                        :index="$index"
                        :id="$ncoupon->ID"
                        :title="$ncoupon->title"
                        :store="$ncoupon->store"
                        :desc="$ncoupon->_ncoupon_desc"
                        :type="$ncoupon->_ncoupon_type"
                        :link="$ncoupon->_ncoupon_link"
                        :code="$ncoupon->_ncoupon_code"
                    />
                @endforeach
                @foreach($paginated_ncoupons as $index => $ncoupon)
                    <x-cobone-card
                        :index="$index"
                        :id="$ncoupon->ID"
                        :title="$ncoupon->title"
                        :store="$ncoupon->store"
                        :desc="$ncoupon->_ncoupon_desc"
                        :type="$ncoupon->_ncoupon_type"
                        :link="$ncoupon->_ncoupon_link"
                        :code="$ncoupon->_ncoupon_code"
                    />
                @endforeach
                @foreach($paginated_ncoupons as $index => $ncoupon)
                    <x-cobone-card
                        :index="$index"
                        :id="$ncoupon->ID"
                        :title="$ncoupon->title"
                        :store="$ncoupon->store"
                        :desc="$ncoupon->_ncoupon_desc"
                        :type="$ncoupon->_ncoupon_type"
                        :link="$ncoupon->_ncoupon_link"
                        :code="$ncoupon->_ncoupon_code"
                    />
                @endforeach
                @foreach($paginated_ncoupons as $index => $ncoupon)
                    <x-cobone-card
                        :index="$index"
                        :id="$ncoupon->ID"
                        :title="$ncoupon->title"
                        :store="$ncoupon->store"
                        :desc="$ncoupon->_ncoupon_desc"
                        :type="$ncoupon->_ncoupon_type"
                        :link="$ncoupon->_ncoupon_link"
                        :code="$ncoupon->_ncoupon_code"
                    />
                @endforeach
                @foreach($paginated_ncoupons as $index => $ncoupon)
                    <x-cobone-card
                        :index="$index"
                        :id="$ncoupon->ID"
                        :title="$ncoupon->title"
                        :store="$ncoupon->store"
                        :desc="$ncoupon->_ncoupon_desc"
                        :type="$ncoupon->_ncoupon_type"
                        :link="$ncoupon->_ncoupon_link"
                        :code="$ncoupon->_ncoupon_code"
                    />
                @endforeach
            </ul>
        @else
            <div class="flex-center-col shadow-md bg-base-300 p-4 rounded-lg rounded-tr-none">
                <h5 class="text-xl font-bold p-2 py-4">لا يوجد كوبونات بعد</h5>
            </div>
        @endif
    </div>


    <div itemscope itemtype="https://schema.org/FAQPage" class="ccontainer p-2 w-full m-auto my-4">
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
