<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

use Artesaos\SEOTools\Facades\SEOTools;
use App\Http\Controllers\Auth\AuthController;

use Corcel\Model\Option;

Route::get('robots', function () {
    return Response()->json(['hello'=>'world']);
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('password/reset', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

// Route::middleware('auth')->group(function () {

Route::get('/', function () {

    try {
        $pageName = 'home';
        $options = Cache::remember('meta_option', 500, function () {
            return Option::where('option_name', 'seo_meta_fields_options')->first();
        });
        $f = unserialize($options->option_value)[$pageName];
        SEOTools::setTitle($f['meta_title']!==''?$f['meta_title']:'الصفحة الرئيسية - كوبون على السريع');
        SEOTools::setDescription($f['meta_description']!==''?$f['meta_description']:'اكتشف أفضل العروض والخصومات على كوبون على السريع. تصفح مجموعتنا المتنوعة من الكوبونات الحصرية واستفد من التخفيضات الفورية لتوفير المزيد على مشترياتك');
        SEOTools::setCanonical($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/');
        SEOTools::addImages($f['og_image']!==''?$f['og_image']:'https://coupon3sari3.com/logo.webp');
        SEOTools::opengraph()->setUrl($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/');
        SEOTools::opengraph()->addProperty('type', 'product.item');
        SEOTools::opengraph()->setDescription($f['og_description']);
        SEOTools::opengraph()->setTitle($f['og_title']);
        SEOTools::twitter()->setUrl($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/');
        SEOTools::twitter()->setSite('@COSN275');
        SEOTools::twitter()->setDescription($f['og_description']);
        SEOTools::twitter()->setTitle($f['og_title']);
    } catch (\Throwable $th) {}

    $stores = [];
    $paginated_ncoupons = Cache::remember('paginated_ncoupons_home', 300, function () {
        $pagcop = Post::type('ncoupons')->status('publish')->latest()->take(12)->get();
        foreach ($pagcop as $index => $coupon) {
            $store = Post::type('stores')->status('publish')->hasMeta('_store_name', $coupon->meta->_ncoupon_store)->with('thumbnail')->first();
            $coupon->store = $store;
        }
        return $pagcop;
    });
    return view('home', compact('paginated_ncoupons'));
})->name('home');

Route::get('/auto-replay', function () {
    try {
        $pageName = 'autoreplay';
        $options = Cache::remember('meta_option', 500, function () {
            return Option::where('option_name', 'seo_meta_fields_options')->first();
        });        
        $f = unserialize($options->option_value)[$pageName];
        SEOTools::setTitle($f['meta_title']!==''?$f['meta_title']:'الرد الالي - كوبون على السريع');
        SEOTools::setDescription($f['meta_description']!==''?$f['meta_description']:'اكتشف أفضل العروض والخصومات على كوبون على السريع. تصفح مجموعتنا المتنوعة من الكوبونات الحصرية واستفد من التخفيضات الفورية لتوفير المزيد على مشترياتك');
        SEOTools::setCanonical($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/auto-replay');
        SEOTools::addImages($f['og_image']!==''?$f['og_image']:'https://coupon3sari3.com/logo.webp');
        SEOTools::opengraph()->setUrl($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/auto-replay');
        SEOTools::opengraph()->addProperty('type', 'product.item');
        SEOTools::opengraph()->setDescription($f['og_description']);
        SEOTools::opengraph()->setTitle($f['og_title']);
        SEOTools::twitter()->setUrl($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/auto-replay');
        SEOTools::twitter()->setSite('@COSN275');
        SEOTools::twitter()->setDescription($f['og_description']);
        SEOTools::twitter()->setTitle($f['og_title']);
    } catch (\Throwable $th) {}

    return view('bots');
})->name('autoreplay');

Route::get('/privacy', function () {

    try {
        $pageName = 'privacy';
        $options = Cache::remember('meta_option', 500, function () {
            return Option::where('option_name', 'seo_meta_fields_options')->first();
        });        
        $f = unserialize($options->option_value)[$pageName];
        SEOTools::setTitle($f['meta_title']!==''?$f['meta_title']:'الخصوصية - كوبون على السريع');
        SEOTools::setDescription($f['meta_description']!==''?$f['meta_description']:'اكتشف أفضل العروض والخصومات على كوبون على السريع. تصفح مجموعتنا المتنوعة من الكوبونات الحصرية واستفد من التخفيضات الفورية لتوفير المزيد على مشترياتك');
        SEOTools::setCanonical($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/privacy');
        SEOTools::addImages($f['og_image']!==''?$f['og_image']:'https://coupon3sari3.com/logo.webp');
        SEOTools::opengraph()->setUrl($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/privacy');
        SEOTools::opengraph()->addProperty('type', 'product.item');
        SEOTools::opengraph()->setDescription($f['og_description']);
        SEOTools::opengraph()->setTitle($f['og_title']);
        SEOTools::twitter()->setUrl($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/privacy');
        SEOTools::twitter()->setSite('@COSN275');
        SEOTools::twitter()->setDescription($f['og_description']);
        SEOTools::twitter()->setTitle($f['og_title']);
    } catch (\Throwable $th) {}

    return view('privacy');
})->name('privacy');

Route::get('/contact', function () {

    try {
        $pageName = 'contact';
        $options = Cache::remember('meta_option', 500, function () {
            return Option::where('option_name', 'seo_meta_fields_options')->first();
        });        
        $f = unserialize($options->option_value)[$pageName];
        SEOTools::setTitle($f['meta_title']!==''?$f['meta_title']:'تواصل - كوبون على السريع');
        SEOTools::setDescription($f['meta_description']!==''?$f['meta_description']:'اكتشف أفضل العروض والخصومات على كوبون على السريع. تصفح مجموعتنا المتنوعة من الكوبونات الحصرية واستفد من التخفيضات الفورية لتوفير المزيد على مشترياتك');
        SEOTools::setCanonical($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/contact');
        SEOTools::addImages($f['og_image']!==''?$f['og_image']:'https://coupon3sari3.com/logo.webp');
        SEOTools::opengraph()->setUrl($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/contact');
        SEOTools::opengraph()->addProperty('type', 'product.item');
        SEOTools::opengraph()->setDescription($f['og_description']);
        SEOTools::opengraph()->setTitle($f['og_title']);
        SEOTools::twitter()->setUrl($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/contact');
        SEOTools::twitter()->setSite('@COSN275');
        SEOTools::twitter()->setDescription($f['og_description']);
        SEOTools::twitter()->setTitle($f['og_title']);
    } catch (\Throwable $th) {}

    return view('contact');
})->name('contact');


Route::get('/about-us', function () {
    try {
        $pageName = 'aboutus';
        $options = Cache::remember('meta_option', 500, function () {
            return Option::where('option_name', 'seo_meta_fields_options')->first();
        });        
        $f = unserialize($options->option_value)[$pageName];
        SEOTools::setTitle($f['meta_title']!==''?$f['meta_title']:'من نحن - كوبون على السريع');
        SEOTools::setDescription($f['meta_description']!==''?$f['meta_description']:'اكتشف أفضل العروض والخصومات على كوبون على السريع. من نحن تصفح مجموعتنا المتنوعة من الكوبونات الحصرية واستفد من التخفيضات الفورية لتوفير المزيد على مشترياتك');
        SEOTools::setCanonical($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/about-us');
        SEOTools::addImages($f['og_image']!==''?$f['og_image']:'https://coupon3sari3.com/logo.webp');
        SEOTools::opengraph()->setUrl($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/about-us');
        SEOTools::opengraph()->addProperty('type', 'product.item');
        SEOTools::opengraph()->setDescription($f['og_description']);
        SEOTools::opengraph()->setTitle($f['og_title']);
        SEOTools::twitter()->setUrl($f['canonical_url']!==''?$f['canonical_url']:'https://coupon3sari3.com/about-us');
        SEOTools::twitter()->setSite('@COSN275');
        SEOTools::twitter()->setDescription($f['og_description']);
        SEOTools::twitter()->setTitle($f['og_title']);
    } catch (\Throwable $th) {}
    return view('about');
})->name('about');


Route::post('/review', [\App\Http\Controllers\ReviewController::class, 'store'])->name('review.store');
Route::get('/coupons', [\App\Http\Controllers\StoreController::class, 'index'])->name('store.index');
Route::get('/coupons/{name}', [\App\Http\Controllers\StoreController::class, 'single'])->name('store.single');
Route::get('/preview/coupons', [\App\Http\Controllers\StoreController::class, 'preview'])->name('store.single.preview');
Route::get('/offers', [\App\Http\Controllers\OfferController::class, 'index'])->name('offers.index');

Route::any('/blog/{any?}', function () {
    return redirect('/blog/index.php');
})->where('any', '.*');
// });