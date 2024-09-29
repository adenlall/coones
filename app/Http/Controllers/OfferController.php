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

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
                    ->paginate(20);
                } catch (\Throwable $th) {
                    return $query->latest()->paginate(20);
                }
            } else {
                return $query->latest()->paginate(20);
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
                        ->paginate(20);
                } catch (\Throwable $th) {
                    return $query->latest()->paginate(20);
                }
            } else {
                return $query->latest()->paginate(20);
            }
        });
        return response()->json(['paginated_offers'=>$paginated_offers]);
    }

}
