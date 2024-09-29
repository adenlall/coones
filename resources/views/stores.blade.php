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
                    <div style="width:fit-content" class="swiper-slide">
                        <button aria-label="عرض الكل"  onclick="getData('all')" id="all" class="cat-item {{app('request')->input('category') ? '' : 'text-accent border-accent font-bold border-[3px]'}} bg-base-100 rounded-full text-center px-6 py-2">
                            عرض الكل
                        </button>
                    </div>
                    @foreach($categories as $category)
                    <div style="width:fit-content" class="swiper-slide">
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
        <div class="ccontainer m-auto w-full full-width">
        @isset($stores)
        <ul id="offerlist" class="grid grid-cols-2 lg:grid-cols-4 items-stretch justify-center gap-5 md:px-0 px-2">
            @foreach($stores as $store)
                <li itemscope itemprop="itemListElement" itemtype="https://schema.org/ListItem" class="w-full h-auto bg-base-100 rounded-md shadow-md shadow-black/30">
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
            const url = "/api/stores"+((type&&type!=='all')?("?category="+type):'');
            // try {
                const response = await fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                    },
                });
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }
                const json = await response.json();
                console.log(json);
            
                const list = document.querySelector("#offerlist");
                list.innerHTML = '';

                json.stores.forEach(store => {
                    const storeName = bringFromList(store.meta, "_store_name");
                    const storeImage = store.image;
                    // Create list item
                    const listItem = document.createElement('li');
                    listItem.className = 'w-full h-auto bg-base-100 rounded-md shadow-md shadow-black/30';
                    // Create anchor tag
                    const anchor = document.createElement('a');
                    anchor.href = `/store/${storeName}`;
                    anchor.className = 'block p-2 w-full h-full';
                    // Create div for image
                    const imageDiv = document.createElement('div');
                    imageDiv.className = 'my-5';
                    // Create image tag
                    const img = document.createElement('img');
                    img.className = 'w-[135px] h-[68px] rounded-md m-auto';
                    img.src = storeImage;
                    img.alt = `شعار متجر ${storeName}`;
                    imageDiv.appendChild(img);
                    // Create horizontal rule
                    const hr = document.createElement('hr');
                    // Create store name heading
                    const h2 = document.createElement('h2');
                    h2.className = 'font-bold my-2 text-lg text-center';
                    h2.textContent = storeName;
                    // Append elements
                    anchor.appendChild(imageDiv);
                    anchor.appendChild(hr);
                    anchor.appendChild(h2);
                    listItem.appendChild(anchor);
                    // Append list item to container
                    list.appendChild(listItem);
                });
                const catItems = document.getElementsByClassName('cat-item');
                for (const element of catItems) {
                    element.classList.remove('text-accent','border-accent','font-bold','border-[3px]');
                }
                document.getElementById(type).classList.add('text-accent','border-accent','font-bold','border-[3px]');
            // } catch (error) {
            //     console.error(error.message);
            // }
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
            console.log('All assets are loaded')
        })
    </script>
    @endpush
    <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script> -->
</x-layout>
