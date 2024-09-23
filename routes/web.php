<?php

use Illuminate\Support\Facades\File;


use Illuminate\Support\Facades\Route;
use Corcel\Model\Post;

Route::get('/', function () {
    $paginated_ncoupons = Post::type('ncoupons')->status('publish')->latest()->take(6)->get();
    foreach ($paginated_ncoupons as $coupon) {
        $store = Post::type('stores')->status('publish')->hasMeta('_store_name', $coupon->meta->_ncoupon_store)->first();
        $coupon->store = $store;
    }
    return view('home', compact('paginated_ncoupons'));
})->name('home');

Route::get('/auto-replay', function () {
    return view('bots');
})->name('autoreplay');

Route::post('/review', [\App\Http\Controllers\ReviewController::class, 'store'])->name('review.store');
Route::get('/store', [\App\Http\Controllers\StoreController::class, 'index'])->name('store.index');
Route::get('/store/{name}', [\App\Http\Controllers\StoreController::class, 'single'])->name('store.single');
Route::get('/offers', [\App\Http\Controllers\OfferController::class, 'index'])->name('offers.index');


Route::get('/blog/{any?}', function ($any = null) {
    // Path to your WordPress index file inside public/blog
    $wordpress_index = public_path('blog/index.php');

    // Forward request to WordPress if the file doesn't exist (handle WordPress routing)
    if (!File::exists(public_path("blog/$any"))) {
        include $wordpress_index;
        exit; // Make sure Laravel stops processing after forwarding to WordPress
    }
    // Return the requested file (e.g., CSS, JS, etc.) if it exists
    return response()->file(public_path("blog/$any"));
})->where('any', '.*');


// Route::any('/blog/{any?}', function () {
//     return redirect('/blog/index.php');
// })->where('any', '.*');
