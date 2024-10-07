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
use Corcel\Model\Option;

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
        $search = $request->search;

        $categories = Cache::remember('stores_categories_items', 300, function () {
            return Taxonomy::where('taxonomy', 'storecategory')->get();
        });

        $cacheKey = 'store_items_' . md5($request->fullUrl() . json_encode($request->all()));
        $stores = Cache::remember($cacheKey, 300, function () use($request, $search) {
            if(isset($request->search)){
                $query = Post::query()->where('post_type', 'stores')->where('post_status', 'publish');
                $query->where('post_title', 'like', '%' . $search . '%');
                $query->orWhereHas('meta', function($subQuery) use ($search) {
                    $subQuery->where('meta_key', '_store_name')
                            ->where('meta_value', 'like', '%' . $search . '%');
                });
                $posts = $query->with('thumbnail')->paginate(44);
                return $posts;
            }else{
                return Post::type('stores')->status('publish')
                ->with('thumbnail')
                ->with(['taxonomies' => function ($query) {
                    $query->where('taxonomy', 'storecategory');
                }])
                ->paginate(44);
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

        try {
            $pageName = 'coupons';
            $options = Cache::remember('meta_option', 500, function () {
            return Option::where('option_name', 'seo_meta_fields_options')->first();
        });        
            $f = unserialize($options->option_value)[$pageName];
            SEOTools::setTitle($f['meta_title']!==''?$f['meta_title']:'جميع المتاجر - كوبون على السريع');
            SEOTools::setDescription($f['meta_description']!==''?$f['meta_description']:'اكتشف أفضل العروض والخصومات على كوبون على السريع. تصفح مجموعتنا المتنوعة من الكوبونات الحصرية واستفد من التخفيضات الفورية لتوفير المزيد على مشترياتك');
            SEOTools::setCanonical($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/coupons');
            SEOTools::addImages($f['og_image']!==''?$f['og_image']:'https://coupon3sari3.com/logo.webp');
            SEOTools::opengraph()->setUrl($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/coupons');
            SEOTools::opengraph()->addProperty('type', 'product.item');
            SEOTools::opengraph()->setDescription($f['og_description']);
            SEOTools::opengraph()->setTitle($f['og_title']);
            SEOTools::twitter()->setUrl($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/coupons');
            SEOTools::twitter()->setSite('@COSN275');
            SEOTools::twitter()->setDescription($f['og_description']);
            SEOTools::twitter()->setTitle($f['og_title']);
        } catch (\Throwable $th) {}


        return view('stores')->with(['categories'=>$categories, 'stores'=>$stores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function single(string $name)
    {
        
        $store = Cache::remember('store_'.md5($name), 300, function () use($name) {
            return Post::type('stores')->status('publish')->hasMeta(['_store_param' => $name])->with('thumbnail')->firstOrFail();
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
