<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOTools;


Route::get('/', function () {

    SEOTools::setTitle('الصفحة الرئيسية - كوبون على السريع');
    SEOTools::setDescription('اكتشف أفضل العروض والخصومات على كوبون على السريع. تصفح مجموعتنا المتنوعة من الكوبونات الحصرية واستفد من التخفيضات الفورية لتوفير المزيد على مشترياتك');
    SEOTools::opengraph()->setUrl('https://coupon3sari3.com/');
    SEOTools::setCanonical('https://coupon3sari3.com/');
    SEOTools::opengraph()->addProperty('type', 'product');
    SEOTools::twitter()->setSite('@COSN275');
    SEOTools::addImages('https://coupon3sari3.com/logo.webp');

    $paginated_ncoupons = Cache::remember('paginated_ncoupons_home', 300, function () {
        $pagcop = Post::type('ncoupons')->status('publish')->latest()->take(12)->get();
        foreach ($pagcop as $coupon) {
            $store = Post::type('stores')->status('publish')->hasMeta('_store_name', $coupon->meta->_ncoupon_store)->with('thumbnail')->first();
            $coupon->store = $store;
        }
        return $pagcop;
    });
    return view('home', compact('paginated_ncoupons'));
})->name('home');

Route::get('/auto-replay', function () {

    SEOTools::setTitle('تقنية الرد الآلي - كوبون على السريع');
    SEOTools::setDescription("استكشف تقنية الرد الآلي على كوبون على السريع. احصل على تحديثات فورية حول العروض والخصومات عبر بوتنا في تيليجرام وكن دائماً على اطلاع بأفضل الكوبونات.");
    SEOTools::opengraph()->setUrl('https://coupon3sari3.com/auto-replay');
    SEOTools::setCanonical('https://coupon3sari3.com/auto-replay');
    SEOTools::opengraph()->addProperty('type', 'product.group');
    SEOTools::twitter()->setSite('@COSN275');
    SEOTools::addImages('https://cosn275.com/wp-content/uploads/2023/05/6603270-1024x1010.png');

    return view('bots');
})->name('autoreplay');

Route::get('/privacy', function () {

    SEOTools::setTitle('سياسة الخصوصية - كوبون على السريع');
    SEOTools::setDescription("استكشف سياسة الخصوصية على كوبون على السريع. احصل على تحديثات فورية حول العروض والخصومات عبر بوتنا في تيليجرام وكن دائماً على اطلاع بأفضل الكوبونات.");
    SEOTools::opengraph()->setUrl('https://coupon3sari3.com/privacy');
    SEOTools::setCanonical('https://coupon3sari3.com/privacy');
    SEOTools::opengraph()->addProperty('type', 'product.group');
    SEOTools::twitter()->setSite('@COSN275');
    SEOTools::addImages('https://cosn275.com/wp-content/uploads/2023/05/6603270-1024x1010.png');

    return view('privacy');
})->name('privacy');

Route::get('/contact', function () {

    SEOTools::setTitle('تواصل معنا - كوبون على السريع');
    SEOTools::setDescription("استكشف تواصل معنا على كوبون على السريع. احصل على تحديثات فورية حول العروض والخصومات عبر بوتنا في تيليجرام وكن دائماً على اطلاع بأفضل الكوبونات.");
    SEOTools::opengraph()->setUrl('https://coupon3sari3.com/privacy');
    SEOTools::setCanonical('https://coupon3sari3.com/privacy');
    SEOTools::opengraph()->addProperty('type', 'product.group');
    SEOTools::twitter()->setSite('@COSN275');
    SEOTools::addImages('https://cosn275.com/wp-content/uploads/2023/05/6603270-1024x1010.png');

    return view('contact');
})->name('contact');

Route::post('/review', [\App\Http\Controllers\ReviewController::class, 'store'])->name('review.store');
Route::get('/store', [\App\Http\Controllers\StoreController::class, 'index'])->name('store.index');
Route::get('/store/{name}', [\App\Http\Controllers\StoreController::class, 'single'])->name('store.single');
Route::get('/preview/store', [\App\Http\Controllers\StoreController::class, 'preview'])->name('store.single.preview');
Route::get('/offers', [\App\Http\Controllers\OfferController::class, 'index'])->name('offers.index');

Route::any('/blog/{any?}', function () {
    return redirect('/blog/index.php');
})->where('any', '.*');
