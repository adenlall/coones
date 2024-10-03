<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>خطأ فادح - 500</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link defer href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body lang="ar" dir="rtl" class="h-screen flex flex-col w-full justify-between">
    <div itemscope itemtype="https://schema.org/SiteNavigationElement" class="bg-base-100">
        <x-navbar />
    </div>
    <div class="flex items-center justify-center">
        <div>
            <h1 class="text-6xl font-bold">500</h1>
            <p class="text-3xl mb-4">عذراً حدث خظأ ما اتناء طلب هاته الصفحة</p>
            <a href="{{ url('/') }}" class="btn btn-primary">العودة للصفحة الرئيسية</a>
        </div>
    </div>
    <x-footer/>
</body>
</html>
