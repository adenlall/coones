<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Corcel\Model\Post;
use JetBrains\PhpStorm\NoReturn;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::type('offers')->status('publish');
        if ($request->has('offer')) {
            $searchTerm = $request->input('offer');
            $query->where(function ($subQuery) use ($searchTerm) {
                $subQuery->where('post_title', 'like', '%' . $searchTerm . '%');
            });
        }
        if ($request->sort) {
            try {
                $paginated_offers = Post::type('offers')
                ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
                ->where('postmeta.meta_key', '_offer_value')
                ->orderBy('postmeta.meta_value', 'DESC')
                ->paginate(30);
            } catch (\Throwable $th) {
                $paginated_offers = $query->latest()->paginate(30);
                dd("err",$paginated_offers, $th);
            }
        } else {
            $paginated_offers = $query->latest()->paginate(30);
        }
        return view('offers', compact('paginated_offers'));
    }

    public function api(Request $request)
    {
        $query = Post::type('offers')->status('publish');
        if ($request->has('offer')) {
            $searchTerm = $request->input('offer');
            $query->where(function ($subQuery) use ($searchTerm) {
                $subQuery->where('post_title', 'like', '%' . $searchTerm . '%');
            });
        }
        if ($request->sort) {
            try {
                $paginated_offers = Post::type('offers')
                ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
                ->where('postmeta.meta_key', '_offer_value')
                ->orderBy('postmeta.meta_value', 'DESC')
                ->paginate(30);
            } catch (\Throwable $th) {
                $paginated_offers = $query->latest()->paginate(30);
                dd("err",$paginated_offers, $th);
            }
        } else {
            $paginated_offers = $query->latest()->paginate(30);
        }
        return response()->json(['paginated_offers'=>$paginated_offers]);
    }

}
