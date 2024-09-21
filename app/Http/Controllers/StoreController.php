<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use Corcel\Model\Taxonomy;
use Corcel\Model\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $categories = Taxonomy::where('taxonomy', 'storecategory')->get();
        if(isset($request->search)){
            $stores = Post::type('stores')->status('publish')->where('post_title', 'like', '%'.($request->search).'%')->paginate(36);
        }else{
            $stores = Post::type('stores')->status('publish')->paginate(36);
        }
        if (isset($request->category)) {
            $stores = Post::published()
            ->whereHas('taxonomies', function($query) use($request) {
                $query->where('taxonomy', 'storecategory')
                    ->whereHas('term', function($query) use($request) {
                        $query->where('slug', urlencode($request->category));
                    });
            })
            ->paginate(36);
            // $stores = Taxonomy::where('taxonomy', 'storecategory')->slug(urlencode($request->category))->with('posts')->get();
        }
        return view('stores')->with(['categories'=>$categories, 'stores'=>$stores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function single(string $name)
    {
        $store = Post::type('stores')->status('publish')->hasMeta('_store_name', $name)->firstOrFail();
        $coupons = Post::type('ncoupons')->status('publish')->latest()->hasMeta('_ncoupon_store', $name)->paginate(360);
        $rate = DB::table('reviews')
        ->where('storeName', $name)
        ->selectRaw('COUNT(*) as total, SUM(CASE WHEN review = 1 THEN 1 ELSE 0 END) as positive')
        ->first();
        $average = round((((int) ($rate->positive?$rate->positive:1)) / ((int) ($rate->total?$rate->total:1)))*100);
        // dd($store);
        return view('store')->with([
            'store'=>$store,
            'rate'=>$this->percentageToStars($average),
            'totalrate'=>$rate->total
        ])->with(compact('coupons'));
    }
}
