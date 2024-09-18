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
        $query = Post::type('coupons')->status('publish');

        // Apply search filter if the 'search' parameter is present
        if ($request->has('offer')) {
            $searchTerm = $request->input('offer');
            $query->where(function ($subQuery) use ($searchTerm) {
                $subQuery->where('post_title', 'like', '%' . $searchTerm . '%');
            });
        }

        // Apply sorting logic if the 'sort' parameter is present
        if ($request->sort) {
            try {
                $paginated_coupons_ids = DB::table('posts as p')
                    ->join('postmeta as pm', 'p.ID', '=', 'pm.post_id')
                    ->where('p.post_type', 'coupons')
                    ->where('p.post_status', 'publish')
                    ->where('pm.meta_key', '_coupon_value')
                    ->orderByRaw('CAST(pm.meta_value AS UNSIGNED) DESC')
                    ->select('p.ID')
                    ->paginate(30);

                $postIds = $paginated_coupons_ids->pluck('ID')->toArray();
                $paginated_coupons = Post::type('coupons')
                    ->whereIn('ID', $postIds)
                    ->orderByRaw("FIELD(ID, " . implode(',', $postIds) . ")")
                    ->get();

                $query=[];
                try {
                    $query = $paginated_coupons_ids->query();
                } catch (\Throwable $th) {
                    $query = [];
                }

                $paginated_coupons = new LengthAwarePaginator(
                    $paginated_coupons,
                    $paginated_coupons_ids->total(),
                    $paginated_coupons_ids->perPage(),
                    $paginated_coupons_ids->currentPage(),
                    ['path' => $paginated_coupons_ids->path(), 'query' => $query]
                );
            
            } catch (\Throwable $th) {
                $paginated_coupons = $query->latest()->paginate(30);
            }
        } else {
            $paginated_coupons = $query->latest()->paginate(30);
        }

        // Fetch the related stores for each coupon
        foreach ($paginated_coupons as $coupon) {
            $store = Post::type('stores')
                ->status('publish')
                ->hasMeta('_store_name', $coupon->meta->_coupon_store)
                ->first();
            $coupon->store = $store;
        }

        return view('offers', compact('paginated_coupons'));
    }

}
