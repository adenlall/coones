<?php

// لا أدري ادا فهمت الفكرة من الحل الاول وهو ان نضيف صفحة في الداشبورد تماما متل صفحة الاسئلة الشائعة و تضيف الاسئلة وستطبق على جميع المتاجر وبامكانك تخصيص الاسئلة متل باستعمال %store% ستعوض بشكل اوتوماتيكي باسم المتجر.

// هدا الحل ايضا يتطلب اتصال بقاعدة البيانات لاكنه اسرع.
// هناك الحل الاسرع وهو ان نضيف الاسئلة في كود الموقع بحث لن تتطلب اي اتصال بالانترنت ولاكن ستفقد ميزة التخصيص الاسئلة مستقبلا
// ادا كانت اسئلة المتاجر ستتكرر فالافضل تضمينها في كود الموقع لأفضل سرعة ممكنة


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

Route::any('/blog/{any?}', function () {
    return redirect('/blog/index.php');
})->where('any', '.*');
