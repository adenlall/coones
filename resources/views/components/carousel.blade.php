<style>
    .swiper-pagination-bullet {
            width: 10px !important;
            height: 10px !important;
            opacity: 0.65 !important;
            border-radius: 50% !important;
            background-color: oklch(var(--b1)) !important;
            margin: 0 5px !important;
            cursor: pointer !important;
            transition: background-color 0.3s ease !important;
        }
    .swiper-pagination-bullet-active {
        background-color: oklch(var(--p)) !important;
        padding-left: 15px !important;
        opacity: 1 !important;
        padding-right: 15px !important;
        border-radius: 10px !important;
    }
</style>
<!-- h-[145px!important] sm:h-[200px!important] md: -->
<div class="bg-base-100 h-auto max-w-[880px] w-full" style="aspect-ratio: 860 / 316;">
    <div style="width:100% !important; padding:0 !important;" class="rounded-box ccontainer m-auto flex items-center justify-center h-[100%!important]">
        <div class="swiper  w-full h-full rounded-box" style="width:100% !important; height:100% !important;">
            <div style="width:100% !important; height:100% !important; padding:0 !important;" class="swiper-wrapper w-full h-full rounded-box">
                @foreach($items as $slide)
                    <a target="_blank" href="{{$slide->_slide_url}}" id="{{$slide->ID}}" class="swiper-slide" style="width:100% !important; height:100% !important; margin:0 !important;">
                        <div style="background: url('{{ $slide->_slide_image}}') center; background-size: cover" class="p-4 bg-accent rounded-box text-3xl w-full h-full"></div>
                    </a>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    window.addEventListener('load', function() {
        const swiper = new Swiper('.swiper', {
            slidesPerView:'auto',
            spaceBetween:'0',
            autoplay: {
                delay: 4000,
                disableOnInteraction: false
            },
            pagination: {
                el: ".swiper-pagination",
            },
            modules: [ Pagination, Autoplay ],
        });
    })
</script>
@endpush