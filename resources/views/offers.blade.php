<x-layout>
    <x-slot:title>
        الصفحة الرئيسية
    </x-slot>
    <div class="ccontainer flex flex-col-reverse md:gap-0 gap-8 md:flex-row-reverse px-4">
    <aside class="p-4 flex flex-col items-center justify-start gap-4">
        <form action="" class="join w-full">
            <input value="{{app('request')->input('offer')}}" name="offer" class="input w-full input-bordered join-item" placeholder="ابحث باسم المتجر" />
            <button type="submit" class="btn join-item rounded-r-full btn-primary">بحث</button>
        </form>
        <div class="w-full">
            <x-aside/>
        </div>
    </aside>
    <div class="m-auto w-full px-4">
        <x-breadcrumbs :items="[['name'=>'الرئيسبة', 'path'=>'/'],['name'=> app('request')->input('sort') === 'top'?'أقوى العروض':'أحدث العروض']]"/>
        @if(app('request')->input('offer'))
            <h1 class="text-3xl font-medium mb-5 mt-2">
                نتائج البحث عن : {{app('request')->input('offer')}}
            </h1>
        @else
            <h1 class="text-3xl font-medium mb-5 mt-2">
                @if(app('request')->input('sort') === 'top')
                    أقوى العروض
                @else
                    احدث العروض
                @endif
            </h1>
        @endif
        <div class="flex gap-3 mb-4">
            <a href="?" class="{{app('request')->input('sort') ? '' : 'text-accent border-accent font-bold border-[3px]'}} bg-base-100 rounded-full text-center px-6 py-2">
                الاحدث
            </a>
            <a href="?sort=top" class="{{app('request')->input('sort') === 'top' ? 'text-accent border-accent font-bold border-[3px]' : ''}} bg-base-100 rounded-full text-center px-6 py-2">
                اقوى الخصومات
            </a>
        </div>
        @if(count($paginated_coupons))
            <ul class="grid grid-cols-1 items-stretch justify-center gap-5 md:px-0 px-2">
                @foreach($paginated_coupons as $coupon)
                    <x-coupon-minimal-card
                        :id="$coupon->ID"
                        :title="$coupon->title"
                        :store="$coupon->store"
                        :desc="$coupon->_coupon_desc"
                        :value="$coupon->_coupon_value"
                        :image="$coupon->_coupon_image"
                        :type="$coupon->_coupon_type"
                        :created="$coupon->post_date"
                        :link="$coupon->_coupon_link"
                        :code="$coupon->_coupon_code"
                    />
                @endforeach
            </ul>
        @endif
        <x-paginator :paginator="$paginated_coupons" />
    </div> 
    </div> 
    @push('scripts')
    <script>
        function showMore(id) {
            var desc = document.getElementById(`desc_${id}`);
            var icon = document.getElementById(`show_icon_${id}`);
            desc.classList.toggle('viss');
            desc.classList.toggle('hidd');
            icon.classList.toggle('rotate-0');
            icon.classList.toggle('rotate-180');
            if (desc.classList.contains('viss')) {
                document.getElementById(`show_more_${id}`).innerText = 'اخفاء المزيد';
            } else {
                document.getElementById(`show_more_${id}`).innerText = 'عرض المزيد';
            }
        }
    </script>
    @endpush
</x-layout>
