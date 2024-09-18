<x-layout>
    <x-slot:title>
        الصفحة الرئيسية
    </x-slot>

    <div class="container m-auto w-full">
        <x-breadcrumbs :items="[['name'=>'الرئيسبة', 'path'=>'/'],['name'=>'جميع المتاجر']]"/>
        <h1 class="text-3xl font-medium mb-3 mt-2">اختر المتجر المفضل لديك!</h1>
        <div class="swiper flex">
            <div class="swiper-wrapper">
                <div style="width:fit-content" class="swiper-slide">
                    <a href="?" class="{{app('request')->input('category') ? '' : 'text-accent border-accent font-bold border-[3px]'}} bg-base-100 rounded-full text-center px-6 py-2">
                        عرض الكل
                    </a>
                </div>
                @foreach($categories as $category)
                <div style="width:fit-content" class="swiper-slide">
                    <a href="?category={{$category->name}}" class="{{app('request')->input('category') === $category->name ? 'text-accent border-accent font-bold border-[3px]':''}} bg-base-100 border-[3px] rounded-full text-center px-6 py-2">
                        {{$category->name}}
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 items-stretch justify-center gap-5 md:px-0 px-2">
            @foreach($stores as $store)
                <li class="w-full h-auto bg-base-100 rounded-md shadow-md shadow-black/30">
                    <a href="/store/{{$store->_store_name}}" class="block p-2 w-full h-full">
                        <div class="my-5">
                            <img class="h-16 rounded-md m-auto" src="{{$store->thumbnail}}" alt="شعار متجر {{$store->_store_name}}"/>
                        </div>
                        <hr/>
                        <h2 class="font-bold my-2 text-lg text-center">
                            {{$store->_store_name}}
                        </h2>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    @push('scripts')
    <script>
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
