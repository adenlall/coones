<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use App\Models\Post;
use JetBrains\PhpStorm\NoReturn;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Artesaos\SEOTools\Facades\SEOTools;
use Corcel\Model\Option;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $pageName = 'offers';
            $options = Option::where('option_name', 'seo_meta_fields_options')->first();        
            $f = unserialize($options->option_value)[$pageName];
            SEOTools::setTitle($f['meta_title']!==''?$f['meta_title']:'جميع العروض - كوبون على السريع');
            SEOTools::setDescription($f['meta_description']!==''?$f['meta_description']:'اكتشف أفضل العروض والخصومات على كوبون على السريع. تصفح مجموعتنا المتنوعة من الكوبونات الحصرية واستفد من التخفيضات الفورية لتوفير المزيد على مشترياتك');
            SEOTools::setCanonical($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/offers');
            SEOTools::addImages($f['og_image']!==''?$f['og_image']:'https://coupon3sari3.com/logo.webp');
            SEOTools::opengraph()->setUrl($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/offers');
            SEOTools::opengraph()->addProperty('type', 'product.item');
            SEOTools::opengraph()->setDescription($f['og_description']);
            SEOTools::opengraph()->setTitle($f['og_title']);
            SEOTools::twitter()->setUrl($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/offers');
            SEOTools::twitter()->setSite('@COSN275');
            SEOTools::twitter()->setDescription($f['og_description']);
            SEOTools::twitter()->setTitle($f['og_title']);
        } catch (\Throwable $th) {}

        $cacheKey = 'offers_' . md5($request->fullUrl() . json_encode($request->all()));
        $paginated_offers = Cache::remember($cacheKey, 300, function () use($request) {
            $query = Post::type('offers')->status('publish')->with(['thumbnail', 'meta']);
            if ($request->has('offer')) {
                $searchTerm = $request->input('offer');
                $query->where(function ($subQuery) use ($searchTerm) {
                    $subQuery->where('post_title', 'like', '%' . $searchTerm . '%');
                });
            }
            if ($request->sort) {
                try {
                    return Post::type('offers')->status('publish')
                    ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
                    ->where('postmeta.meta_key', '_offer_value')
                    ->orderBy('postmeta.meta_value', 'DESC')
                    ->paginate(15);
                } catch (\Throwable $th) {
                    return $query->latest()->paginate(15);
                }
            } else {
                return $query->latest()->paginate(15);
            }
        });
        return view('offers', compact('paginated_offers'));
    }

    public function api(Request $request)
    {
        $cacheKey = 'api_offers_' . md5($request->fullUrl() . json_encode($request->all()));
        $paginated_offers = Cache::remember($cacheKey, 300, function () use($request) {
            $query = Post::type('offers')->status('publish');
            if ($request->has('offer')) {
                $searchTerm = $request->input('offer');
                $query->where(function ($subQuery) use ($searchTerm) {
                    $subQuery->where('post_title', 'like', '%' . $searchTerm . '%');
                });
            }
            if ($request->sort) {
                try {
                    return Post::type('offers')->status('publish')
                        ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
                        ->where('postmeta.meta_key', '_offer_value')
                        ->orderBy('postmeta.meta_value', 'DESC')
                        ->paginate(15);
                } catch (\Throwable $th) {
                    return $query->latest()->paginate(15);
                }
            } else {
                return $query->latest()->paginate(15);
            }
        });
        return response()->json(['paginated_offers'=>$paginated_offers]);
    }

}
