<?php

use Illuminate\Support\Facades\Route;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use Corcel\Model\Taxonomy;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;


Route::get('/stores', function (Request $request) {
    $cacheKey = 'api_store_items_' . md5($request->fullUrl() . json_encode($request->all()));
    $stores = Cache::remember($cacheKey, 300, function () use($request) {
        if (isset($request->category)) {
            return Post::type('stores')->status('publish')
                ->whereHas('taxonomies', function($query) use($request) {
                    $query->where('taxonomy', 'storecategory')
                        ->whereHas('term', function($query) use($request) {
                            $query->where('slug', urlencode($request->category));
                        });
                })->with('thumbnail')
                ->take(20)->get();
        } else {
            return Post::type('stores')->status('publish')->with('thumbnail')->get();
        }
    });
    return response()->json(['stores'=>$stores]);
});

Route::post('/review', [\App\Http\Controllers\ReviewController::class, 'store']);

Route::get('/offers', [\App\Http\Controllers\OfferController::class, 'api']);
