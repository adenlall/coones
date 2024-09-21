<?php

use Illuminate\Support\Facades\Route;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use Corcel\Model\Taxonomy;
use Corcel\Model\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


Route::get('/stores', function (Request $request) {
    if (isset($request->category)) {
        $stores = Post::published()->type('stores')
        ->whereHas('taxonomies', function($query) use($request) {
            $query->where('taxonomy', 'storecategory')
                ->whereHas('term', function($query) use($request) {
                    $query->where('slug', urlencode($request->category));
                });
        })
        ->get();
    }else{
        $stores = Post::published()->type('stores');
    }
    return response()->json(['stores'=>$stores]);
});

Route::post('/review', [\App\Http\Controllers\ReviewController::class, 'store']);

Route::get('/offers', [\App\Http\Controllers\OfferController::class, 'api']);
