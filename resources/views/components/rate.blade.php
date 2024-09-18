<div class="flex-center-row gap-2 {{app('request')->input('review')&& (string) app('request')->input('modal') === (string) $id?'pb-6':''}}">
    <p>هل الكود يعمل؟</p>
    <div class="flex-center-row gap-2">
        <form method="POST" action="{{route('review.store')}}" class="h-fit m-0">
            @csrf
            <input name="couponId" type="hidden" value="{{$id}}"/>
            <input name="storeName" type="hidden" value="{{$store}}"/>
            <input name="review" type="hidden" value="1"/>
            <input name="fingerprint" type="hidden" value="{{\Illuminate\Support\Str::random(25)}}"/>
            <button type="submit" class="flex-center-row gap-1 border-gray-400 border-[1px] text-base-content/80 py-1 px-3 rounded">
                <x-bx-like class="h-auto w-4"/>
                <span>
                    نعم
                </span>
            </button>
        </form>
        <form method="POST" action="{{route('review.store')}}" class="h-fit m-0">
            @csrf
            <input name="couponId" type="hidden" value="{{$id}}"/>
            <input name="storeName" type="hidden" value="{{$store}}"/>
            <input name="review" type="hidden" value="0"/>
            <input name="fingerprint" type="hidden" value="{{\Illuminate\Support\Str::random(25)}}"/>
            <button type="submit" class="flex-center-row gap-1 border-gray-400 border-[1px] text-base-content/80 py-1 px-3 rounded">
                <x-bx-dislike class="h-auto w-4"/>
                <span>
                    لا
                </span>
            </button>
        </form>
    </div>
</div>

@if((string) app('request')->input('review') === "false" && (string) app('request')->input('modal') === (string) $id)
    <span class="m-auto px-3 rounded-md py-1 bg-error text-error-content">
        متأسفين على ذلك وسوف يتم مراجعة الكوبون
    </span>    
@elseif((string) app('request')->input('review') === "true" && (string) app('request')->input('modal') === (string) $id)
    <span class="m-auto px-3 rounded-md py-1 bg-success text-success-content">
        شكراً لك على التأكيد 🌹
    </span>
@endif