<div class="flex-center-row gap-2 {{app('request')->input('review')&& (string) app('request')->input('modal') === (string) $id?'pb-6':''}}">
    <p>هل الكود يعمل؟</p>
    <div class="flex-center-row gap-2">
        <div class="h-fit m-0">
            <button onclick="postReview({couponId:'{{$id}}', storeName:'{{$store}}', review:'1', fingerprint:'{{\Illuminate\Support\Str::random(25)}}' })" type="submit" class="flex-center-row gap-1 border-gray-400 border-[1px] text-base-content/80 py-1 px-3 rounded">
                <x-bx-like class="h-auto w-4"/>
                <span>
                    نعم
                </span>
            </button>
        </div>
        <div class="h-fit m-0">
            <button onclick="postReview({couponId:'{{$id}}', storeName:'{{$store}}', review:'0', fingerprint:'{{\Illuminate\Support\Str::random(25)}}' })" type="submit" class="flex-center-row gap-1 border-gray-400 border-[1px] text-base-content/80 py-1 px-3 rounded">
                <x-bx-dislike class="h-auto w-4"/>
                <span>
                    لا
                </span>
            </button>
        </div>
    </div>
</div>

<span style="display:none;" id="{{$id}}-{{urlencode($store)}}-0" class="m-auto px-3 rounded-md mt-3 py-1 bg-error text-error-content">
    متأسفين على ذلك وسوف يتم مراجعة الكوبون
</span>    
<span style="display:none;" id="{{$id}}-{{urlencode($store)}}-1" class="m-auto px-3 rounded-md mt-3 py-1 bg-success text-success-content">
    شكراً لك على التأكيد 🌹
</span>