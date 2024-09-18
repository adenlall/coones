<dialog id="coupon_modal_{{$id}}_o" class="modal">
    <div class="modal-box rounded-md shadow-lg shadow-black/30">
    <div class="text-center p-4 max-w-sm mx-auto">
        <img class="m-auto mb-6 h-12" src="{{$store->thumbnail}}" alt="شعار متجر {{$store->_store_name}}"/>
        <p class="text-xl font-bold mb-6">{{$title}}</p>
        <div class="flex rounded-full justify-center items-center m-auto my-8 p-1 w-fit bg-base-200">
            <div id="coupon_modal_{{$id}}_code" class="py-2 px-4 text-xl font-extrabold mr-1 min-w-[6em]">{{$code}}</div>
            <div onclick="function handler() {
                const couponElement = document.querySelector('#coupon_modal_{{$id}}_code');
                const originalText = couponElement.innerText;
                couponElement.innerText = 'تم النسخ!';
                navigator.clipboard.writeText('{{$code}}');
                setTimeout(() => {
                    couponElement.innerText = originalText;
                }, 2000);
            }
        handler()" class="bg-accent cursor-pointer rounded-full text-accent-content p-2 text-lg font-bold px-6">نسخ</div>
        </div>
        <p class="text-md mb-6">قم بنسخ الكود وألصقه في <a class="underline text-purple-900" target="_blank" href="{{$link?$link:$store->_store_url}}">{{$store->_store_name}}</a></p>
        <x-rate :id="$id" :store="$store->_store_name" />

        <form method="dialog" class="absolute p-2 top-0 left-0">
            <button class="btn rounded-sm btn-circle btn-sm"><x-tabler-x /></button>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop absolute top-0">
        <button>اغلاق</button>
    </form>
</dialog>
