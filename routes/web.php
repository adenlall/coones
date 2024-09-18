<?php

use Illuminate\Support\Facades\Route;
use Corcel\Model\Post;

Route::get('/', function () {
    $paginated_coupons = Post::type('coupons')->status('publish')->latest()->take(6)->get();
    foreach ($paginated_coupons as $coupon) {
        $store = Post::type('stores')->status('publish')->hasMeta('_store_name', $coupon->meta->_coupon_store)->first();
        $coupon->store = $store;
    }
    return view('home', compact('paginated_coupons'));
})->name('home');

Route::post('/review', [\App\Http\Controllers\ReviewController::class, 'store'])->name('review.store');
Route::get('/store', [\App\Http\Controllers\StoreController::class, 'index'])->name('store.index');
Route::get('/store/{name}', [\App\Http\Controllers\StoreController::class, 'single'])->name('store.single');
Route::get('/offers', [\App\Http\Controllers\OfferController::class, 'index'])->name('store.index');

Route::get('/blog/{any?}', function () {
    return redirect('/blog/index.php');
})->where('any', '.*');
