<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use JetBrains\PhpStorm\NoReturn;
use Illuminate\Http\Request;
use Corcel\Model\Option;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        $req = $request->validated();
        Review::create($req);
        return $req['review'] === "1" ? 'true' : 'false';
        // return redirect()->route('home',['modal'=>$req['couponId'],'review'=> ((string) $req['review'] === "1" ? 'true':'false') , '#card_'.$req['couponId'].'_p']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
