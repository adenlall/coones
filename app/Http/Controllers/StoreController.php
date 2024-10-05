<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use Corcel\Model\Taxonomy;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Artesaos\SEOTools\Facades\SEOTools;

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

        $categories = Cache::remember('stores_categories_items', 300, function () {
            return Taxonomy::where('taxonomy', 'storecategory')->get();
        });

        $cacheKey = 'store_items_' . md5($request->fullUrl() . json_encode($request->all()));
        $stores = Cache::remember($cacheKey, 300, function () use($request) {
            if(isset($request->search)){
                return Post::type('stores')->status('publish')
                ->where('post_title', 'like', '%'.($request->search).'%')
                ->with('thumbnail')->paginate(44);
            }else{
                return Post::type('stores')->status('publish')
                ->with('thumbnail')
                ->with(['taxonomies' => function ($query) {
                    $query->where('taxonomy', 'storecategory');
                }])
                ->paginate(44);
                // dd($stores[0]->taxonomies);
            }
            if (isset($request->category)) {
                return Post::published()
                ->whereHas('taxonomies', function($query) use($request) {
                    $query->where('taxonomy', 'storecategory')
                        ->whereHas('term', function($query) use($request) {
                            $query->where('slug', urlencode($request->category));
                        });
                })->with('thumbnail')
                ->paginate(44);
            }
        });

        SEOTools::setTitle('جميع المتاجر والكوبونات - كوبون على السريع');
        SEOTools::setDescription("تصفح جميع المتاجر والكوبونات المتاحة على كوبون على السريع. احصل على خصومات حصرية وعروض مميزة من متاجر متنوعة لتوفير المزيد على مشترياتك.");
        SEOTools::opengraph()->setUrl('https://coupon3sari3.com/coupons');
        SEOTools::setCanonical('https://coupon3sari3.com/coupons');
        SEOTools::opengraph()->addProperty('type', 'product.group');
        SEOTools::twitter()->setSite('@COSN275');
        SEOTools::addImages('https://coupon3sari3.com/logo.webp');

        return view('stores')->with(['categories'=>$categories, 'stores'=>$stores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function single(string $name)
    {
        
        $store = Cache::remember('store_'.md5($name), 300, function () use($name) {
            $fstore = Post::type('stores')->status('publish')->hasMeta(['_store_name' => $name])->with('thumbnail')->first();
            if ($fstore) {
                return $fstore;
            } else {
                return Post::type('stores')->status('publish')->hasMeta(['_store_param' => $name])->with('thumbnail')->firstOrFail();
            }
        });

        $coupons = Cache::remember('store_coupons_'.md5($store->_store_name), 300, function () use($store) {
            return Post::type('ncoupons')->status('publish')->latest()->hasMeta('_ncoupon_store', $store->_store_name)->paginate(360);
        });
        $stats = Cache::remember('store_stats_'.md5($store), 300, function () use($store) {
            $rate = DB::table('reviews')
            ->where('storeName', $store->_store_name)
            ->selectRaw('COUNT(*) as total, SUM(CASE WHEN review = 1 THEN 1 ELSE 0 END) as positive')
            ->first();
            $average = round((((int) ($rate->positive?$rate->positive:1)) / ((int) ($rate->total?$rate->total:1)))*100);
            return ['rate'=>$rate, 'average'=>$average];
        });
        $title = $store->rank_math_title;
        $description = $store->rank_math_description;
        $fdescription = $store->rank_math_facebook_description;
        $ftitle = $store->rank_math_facebook_title;

        SEOTools::setTitle($title??($store->title .' - كوبون على السريع'));
        SEOTools::setDescription($description??("اكتشف خصومات مذهلة في متجر ".$store->_store_name." على كوبون على السريع. احصل على أفضل العروض والكوبونات الحصرية لتوفير المزيد على مشترياتك."));

        SEOTools::setCanonical('https://coupon3sari3.com/coupons/'.$store->_store_name);

        SEOTools::opengraph()->setUrl('https://coupon3sari3.com/coupons/'.$store->_store_name);
        SEOTools::opengraph()->addProperty('type', 'product.item');
        SEOTools::opengraph()->setDescription($fdescription??($description??("اكتشف خصومات مذهلة في متجر ".$store->_store_name." على كوبون على السريع. احصل على أفضل العروض والكوبونات الحصرية لتوفير المزيد على مشترياتك.")));
        SEOTools::opengraph()->setTitle($ftitle??($title??($store->title .' - كوبون على السريع')));

        SEOTools::twitter()->setUrl('https://coupon3sari3.com/coupons/'.$store->_store_name);
        SEOTools::twitter()->setSite('@COSN275');
        SEOTools::twitter()->setDescription($fdescription??($description??("اكتشف خصومات مذهلة في متجر ".$store->_store_name." على كوبون على السريع. احصل على أفضل العروض والكوبونات الحصرية لتوفير المزيد على مشترياتك.")));
        SEOTools::twitter()->setTitle($ftitle??($ftitle??($title .' - كوبون على السريع')));

        SEOTools::addImages($store->thumbnail);

        return view('store')->with([
            'store'=>$store,
            'rate'=>$this->percentageToStars($stats['average']),
            'totalrate'=>$stats['rate']->total
        ])->with(compact('coupons'));
    }


    /**
     * preview.
     */
    public function preview(Request $request)
    {
        $post = Post::find($request->id);
        try {
            $store = $post->revision()->orderBy('ID', 'desc')->first();
        } catch (\Throwable $th) {
            return redirect()->back();
        }
        try {
            $store->meta = $post->meta;
            $store->thumbnail = Post::find($request->thumbnail)->guid;
        } catch (\Throwable $th) {
            $store->thumbnail = $post->thumbnail;
        }

        SEOTools::setDescription("اكتشف خصومات مذهلة في متجر على كوبون على السريع. احصل على أفضل العروض والكوبونات الحصرية لتوفير المزيد على مشترياتك.");
        SEOTools::setTitle( $store->title .' - كوبون على السريع');
        SEOTools::addImages($store->thumbnail);

        $coupons = Cache::remember('store_coupons_'.md5($request->name), 300, function () use($request) {
            return Post::type('ncoupons')->status('publish')->latest()->hasMeta('_ncoupon_store', $request->name)->paginate(360);
        });

        $rate = DB::table('reviews')
            ->where('storeName', $request->name)
            ->selectRaw('COUNT(*) as total, SUM(CASE WHEN review = 1 THEN 1 ELSE 0 END) as positive')
            ->first();
        $average = round((((int) ($rate->positive?$rate->positive:1)) / ((int) ($rate->total?$rate->total:1)))*100);

        return view('store')->with([
            'store'=>$store,
            'rate'=>$this->percentageToStars($average),
            'totalrate'=>$rate->total
        ])->with(compact('coupons'));
    }
}
