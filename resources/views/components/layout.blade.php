<!DOCTYPE html>
<html data-theme="cobones" lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link defer href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    {!! SEO::generate() !!}
    <!-- {!! app('seotools')->generate() !!} -->
    <!-- 
        TODO:
         * add all meta tags < Description Opengraph Twitter >
         * DONE :: add sitemap.xml
         * DONE :: add Schema.org
         * add Language Doctype Encodingc Canonical Robots Tags 
     -->
    @vite('resources/css/app.css')
    @stack('styles')
    <div itemscope itemtype="https://schema.org/WebSite">
        <meta itemprop="name" content="كوبون على السريع">
        <meta itemprop="url" content="https://coral-quetzal-195094.hostingersite.com/">
        <div itemscope itemprop="potentialAction" itemtype="https://schema.org/SearchAction">
            <meta itemprop="target" content="https://coral-quetzal-195094.hostingersite.com/store?search={search_term_string}">
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
