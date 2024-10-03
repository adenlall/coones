<x-layout>
    <div itemscope itemtype="https://schema.org/ItemList" class="w-full bg-base-100 mb-6">
        <div class="ccontainer m-auto w-full">
            <x-breadcrumbs :items="[['name'=>'الرئيسية', 'path'=>'/'],['name'=>'جميع المتاجر']]"/>
            <meta itemprop="itemListOrder" content="ascending" />
            @if(app('request')->input('search'))
                <meta itemprop="name" content="اختر المتجر المفضل لديك" />
                <h1 class="text-3xl font-medium mb-3 mt-2">نتائج البحث عن : {{app('request')->input('search')}}</h1>
            @else
                <meta itemprop="name" content="اختر المتجر المفضل لديك" />
                <h1 class="text-3xl font-medium mb-3 mt-2">اختر المتجر المفضل لديك!</h1>
            @endif
            <div class="swiper flex">
                @isset($categories)
                <div class="swiper-wrapper">
                    <div style="width:auto" class="swiper-slide">
                        <button aria-label="عرض الكل"  onclick="getData('all')" id="all" class="cat-item {{app('request')->input('category') ? '' : 'text-accent border-accent font-bold border-[3px]'}} bg-base-100 rounded-full text-center px-6 py-2">
                            عرض الكل
                        </button>
                    </div>
                    @foreach($categories as $category)
                    <div style="width:auto" class="swiper-slide">
                        <button aria-label="{{$category->name}}" onclick="getData('{{$category->name}}')" id="{{$category->name}}" class="cat-item {{app('request')->input('category') === $category->name ? 'text-accent border-accent font-bold border-[3px]':''}} bg-base-100 border-[3px] rounded-full text-center px-6 py-2">
                            {{$category->name}}
                        </button>
                    </div>
                    @endforeach
                </div>
                @endisset
            </div>
        </div>
        </div>
        <div class="ccontainer m-auto w-full full-width min-h-[50vh]">
        @isset($stores)
        <ul id="offerlist" class="grid grid-cols-2 lg:grid-cols-4 items-stretch justify-center gap-5 md:px-0 px-2">
            @foreach($stores as $store)
                <li data-filters="@foreach($store->taxonomies as $taxonomy) {{urldecode($taxonomy->slug)}} @endforeach" itemscope itemprop="itemListElement" itemtype="https://schema.org/ListItem" class="w-full h-auto bg-base-100 rounded-md shadow-md shadow-black/30">
                    <a aria-label="{{$store->_store_name}}" itemscope itemtype="https://schema.org/Organization" href="/store/{{$store->_store_name}}" class="block p-2 w-full h-full">
                        <div class="my-5">
                            <img itemprop="logo" class="w-[135px] h-[68px] rounded-md m-auto" src="{{$store->thumbnail}}" alt="شعار متجر {{$store->_store_name}}"/>
                        </div>
                        <hr/>
                        <h2 itemprop="name" class="font-bold my-2 text-lg text-center">
                            {{$store->_store_name}}
                        </h2>
                    </a>
                </li>
            @endforeach
        </ul>
        <x-paginator :paginator="$stores" />
        @endisset
    </div>
    @push('scripts')
    <script>
        async function getData(type) {
            console.log(type);
            const itemList = document.getElementById('offerlist');
            const items = itemList.getElementsByTagName('li');
            for (let item of items) {
                if (item.getAttribute('data-filters').includes(type !== 'all' ? type : '')) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            }
            const catItems = document.getElementsByClassName('cat-item');
            for (const element of catItems) {
                element.classList.remove('text-accent','border-accent','font-bold','border-[3px]');
                element.classList.add('border-base-200','border-[3px]');
            }
            document.getElementById(type).classList.remove('border-base-200');
            document.getElementById(type).classList.add('text-accent','border-accent','font-bold','border-[3px]');
        }
        function bringFromList(list, meta_key) {
            for (const item of list) {
                if (item.meta_key === meta_key) {
                    console.log("item", item);
                    return item.meta_value; // Return value when found
                }
            }
        }
        window.addEventListener('load', function() {
            const swiper = new Swiper('.swiper', {
                slidesPerView:"auto"
            });
        })
    </script>
    @endpush
    <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script> -->
</x-layout>
