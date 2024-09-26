<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use Corcel\Model\Taxonomy;
use Corcel\Model\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class StoreController extends Controller
{
    private function percentageToStars($percentage) {
        $percentage = max(0, min(100, $percentage));
        $stars = round($percentage / 20 * 2) / 2;
        return $stars;
        return $stars;
    }    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Cache::remember('stores_categories', 300, function () {
            return Taxonomy::where('taxonomy', 'storecategory')->get();
        });

        $cacheKey = 'stores_list_' . md5($request->fullUrl() . json_encode($request->all()));
        $stores = Cache::remember($cacheKey, 300, function () use($request) {
            if(isset($request->search)){
                return Post::type('stores')->status('publish')->where('post_title', 'like', '%'.($request->search).'%')->paginate(36);
            }else{
                return Post::type('stores')->status('publish')->paginate(36);
            }
            if (isset($request->category)) {
                return Post::published()
                ->whereHas('taxonomies', function($query) use($request) {
                    $query->where('taxonomy', 'storecategory')
                        ->whereHas('term', function($query) use($request) {
                            $query->where('slug', urlencode($request->category));
                        });
                })
                ->paginate(36);
            }
        });
        return view('stores')->with(['categories'=>$categories, 'stores'=>$stores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function single(string $name)
    {
        $store = Cache::remember('store_'.md5($name), 300, function () use($name) {
            return Post::type('stores')->status('publish')->hasMeta('_store_name', $name)->firstOrFail();
        });
        $coupons = Cache::remember('coupons_'.md5($name), 300, function () use($name) {
            return Post::type('ncoupons')->status('publish')->latest()->hasMeta('_ncoupon_store', $name)->paginate(360);
        });
        $stats = Cache::remember('stats_'.md5($name), 300, function () use($name) {
            $rate = DB::table('reviews')
            ->where('storeName', $name)
            ->selectRaw('COUNT(*) as total, SUM(CASE WHEN review = 1 THEN 1 ELSE 0 END) as positive')
            ->first();
            $average = round((((int) ($rate->positive?$rate->positive:1)) / ((int) ($rate->total?$rate->total:1)))*100);
            return ['rate'=>$rate, 'average'=>$average];
        });
        return view('store')->with([
            'store'=>$store,
            'rate'=>$this->percentageToStars($stats['average']),
            'totalrate'=>$stats['rate']->total
        ])->with(compact('coupons'));
    }
}
