<x-layout>
    <x-slot:title>
        الصفحة الرئيسية
    </x-slot>
    <div class="w-full bg-base-100 mb-8 pb-4">
    <div class="ccontainer full-width bg-base-100" style="padding:0px 20px;">
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
            <button id="all" onclick="getData('all')" class="cat-item {{app('request')->input('sort') ? '' : 'text-accent border-accent font-bold border-[3px]'}} bg-base-100 border-[3px] rounded-full text-center px-6 py-2">
                الاحدث
            </button>
            <button id="top" onclick="getData('top')" class="cat-item {{app('request')->input('sort') === 'top' ? 'text-accent border-accent font-bold border-[3px]' : ''}} bg-base-100 border-[3px] rounded-full text-center px-6 py-2">
                اقوى الخصومات
            </button>
        </div>
    </div>
    </div>

    <div class="ccontainer flex flex-col-reverse md:gap-0 gap-8 md:flex-row-reverse px-2">
    <aside class="p-4 flex w-[40%] flex-col items-center justify-start gap-4">
        <!-- <form action="" class="join w-full min-w-full">
            <input value="{{app('request')->input('offer')}}" name="offer" class="input w-full input-bordered join-item" placeholder="ابحث باسم المتجر" />
            <button type="submit" class="btn join-item rounded-r-full btn-primary">بحث</button>
        </form> -->
        <div class="w-full">
            <x-aside/>
        </div>
    </aside>
    <div class="m-auto w-full px-4">
        @if(count($paginated_offers))
            <ul id="offerlist" class="grid grid-cols-1 items-stretch justify-center gap-5 md:px-0 px-2">
                @foreach($paginated_offers as $offer)
                    <x-coupon-minimal-card
                        :id="$offer->ID"
                        :title="$offer->title"
                        :store="$offer->_offer_store"
                        :desc="$offer->content"
                        :value="$offer->_offer_value"
                        :image="$offer->_offer_image"
                        :type="$offer->_offer_type"
                        :created="$offer->post_date"
                        :link="$offer->_offer_link"
                        :code="$offer->_offer_code"
                    />
                @endforeach
            </ul>
        @endif
        <x-paginator :paginator="$paginated_offers" />
    </div> 
    </div> 
    @push('scripts')
    <script>

        async function getData(type) {
            const url = "/api/offers"+(type==='top'?'?sort=top':'');
            try {
                const response = await fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                    },
                });
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }
                const json = await response.json();
                
                const list = document.querySelector("#offerlist");
                
                list.innerHTML = '';
                let liElements = '';
                const elem = (id, image, created, sort, title, value, desc, link, store_name) => `
                    <div id="card_${id}_p" class="flex flex-col items-center shadow-md shadow-black/30 rounded-md bg-base-100 space-y-2 w-full lg:w-[790px]">
                        <div style="background:${image ? `url(${image})` : ''}; background-size:cover;" class="w-full min-h-[14em] lg:min-h-[318px] border-accent border-[3px] border-r-[7px] bg-primary"></div>
                        <div class="p-2 pr-4 w-full flex flex-col justify-between h-full">
                            <div class="w-full space-y-2">
                                <span>تاريخ النشر : ${created}</span>
                                ${type === 'top' ? `<span class='badge badge-primary mx-2'>خصم ${value}%</span>` : ''}
                                <h3 class="text-lg font-bold">${title}</h3>
                            </div>
                            <p id="desc_${id}" class="hidd w-full text-lg py-2">${desc}</p>
                            <div class="w-full mt-2 flex flex-wrap justify-between items-center gap-2">
                                <h5 onclick="showMore(${id})" class="pb-4 relative z-10 pt-1 cursor-pointer w-fit flex gap-1 pr-4 text-accent">
                                    <span id="show_more_${id}">عرض التفاصيل</span>
                                    <svg id="show_icon_${id}" class="rotate-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 9l6 6l6 -6"></path>
                                    </svg>
                                </h5>
                                <div class="flex flex-wrap gap-2 p-2">
                                    <a href="/store/${store_name}" class="btn btn-sm text-lg px-4 h-[2em] font-bold btn-accent rounded-full">كود خصم إضافي</a>
                                    ${link ? `<a target="_blank" href="${link}" class="btn btn-sm text-lg px-4 h-[2em] font-bold btn-accent rounded-full">زيارة العرض</a>` : ''}
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                json.paginated_offers.data.forEach(item => {
                    liElements += elem(item.ID, bringFromList(item.meta,'_offer_image'), item.post_date?.split('T')[0], 'sort', item.title, bringFromList(item.meta,'_offer_value'), bringFromList(item.meta,'_offer_desc'), bringFromList(item.meta,'_offer_link'), bringFromList(item.meta,'_offer_store'));
                });
                list.innerHTML += liElements;
                const catItems = document.getElementsByClassName('cat-item');
                for (const element of catItems) {
                    element.classList.remove('text-accent','border-accent','font-bold');
                }
                document.getElementById(type).classList.add('text-accent','border-accent','font-bold');
            } catch (error) {
                console.error(error.message);
            }
        }
        function bringFromList(list, meta_key) {
            for (const item of list) {
                if (item.meta_key === meta_key) {
                    console.log("item", item);
                    return item.meta_value;
                }
            }
        }
        function showMore(id) {
            var desc = document.getElementById(`desc_${id}`);
            var icon = document.getElementById(`show_icon_${id}`);
            desc.classList.toggle('viss');
            desc.classList.toggle('hidd');
            icon.classList.toggle('rotate-0');
            icon.classList.toggle('rotate-180');
            if (desc.classList.contains('viss')) {
                document.getElementById(`show_more_${id}`).innerText = 'اخفاء التفاصيل';
            } else {
                document.getElementById(`show_more_${id}`).innerText = 'عرض التفاصيل';
            }
        }
    </script>
    @endpush
</x-layout>
