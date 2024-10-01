<!DOCTYPE html>
<html data-theme="cobones" lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link defer href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon-16x16.png">
    <link rel="manifest" href="/icons/site.webmanifest">
    <link rel="mask-icon" href="/icons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="كوبون على السريع">
    <meta name="application-name" content="كوبون على السريع">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="msapplication-config" content="/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffd50e">

    {!! SEO::generate() !!}
    @vite('resources/css/app.css')
    @stack('styles')
    <div itemscope itemtype="https://schema.org/WebSite">
        <meta itemprop="name" content="كوبون على السريع">
        <meta itemprop="url" content="https://coupon3sari3.com/">
        <div itemscope itemprop="potentialAction" itemtype="https://schema.org/SearchAction">
            <meta itemprop="target" content="https://coupon3sari3.com/store?search={search_term_string}">
            <meta itemprop="query-input" content="required name=search_term_string">
        </div>
    </div>
</head>
<body class="bg-base-200">

<div class="drawer">
    <input aria-label="فتح القائمة الجانبية" id="my-drawer-3" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col">
        <!-- Navbar -->
        <div itemscope itemtype="https://schema.org/SiteNavigationElement" class="bg-base-100">
            <x-navbar />
        </div>
        <!-- Page content here -->
        {{ $slot }}

    </div>
    <div class="drawer-side z-50">
        <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4 gap-2">
            <x-nav-menu/>
        </ul>
    </div>
</div>
<x-footer/>
@vite('resources/js/app.js')
@stack('scripts')

<script>
    async function postReview(type) {
        console.log('postReview',type);
        const url = "/api/review?couponId="+type.couponId+"&storeName="+type.storeName+"&review="+type.review+"&fingerprint="+type.fingerprint;
        try {
            const response = await fetch(url, {
                method:'POST',
                headers: {
                    "Content-Type": "application/json",
                },
            });
            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }
            const json = await response.json();
            console.log('json',json);
            if(type.couponId){
                if (json === true || json === 'true') {
                    document.getElementById(type.couponId+'-'+encodeURIComponent(type.storeName)+'-1').style.display = 'block';
                    document.getElementById(type.couponId+'-'+encodeURIComponent(type.storeName)+'-0').style.display = 'none';
                }else{
                    document.getElementById(type.couponId+'-'+encodeURIComponent(type.storeName)+'-0').style.display = 'block';
                    document.getElementById(type.couponId+'-'+encodeURIComponent(type.storeName)+'-1').style.display = 'none';
                }
            }
        } catch (error) {
            console.error(error);
        }
    }
</script>
</body>
</html>
