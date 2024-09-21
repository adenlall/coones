<!-- 
<style>
    .carousel {
        position: relative;
        overflow: hidden;
    }
    .carousel-item {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }
    .carousel-item.active {
        opacity: 1;
    }
    .carousel-dots {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: oklch(var(--p)/.5);
        margin: 0 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .swiper-pagination-bullet-active {
        background-color: oklch(var(--p));
        padding-left: 25px;
        padding-right: 25px;
        border-radius: 10px;
    }
</style>


<div id="carousel" class="carousel  box:min-w-[860px] bg-red-500 min-w-0 min-h-0 w-full h-[300px] box:min-h-[315px] rounded-box">
    @foreach($items as $index => $slide)
        <div id="{{ $slide->ID }}" class="carousel-item {{ $index === 0 ? 'active' : '' }} relative w-full">
            <a href="{{$slide->_slide_url}}" class="w-full h-full">
                <div style="background: url('{{ $slide->_slide_image}}') center; background-size: cover" class="h-full flex flex-col items-center justify-between w-full rounded-box">
                </div>
            </a>
        </div>
    @endforeach
    <div class="w-full flex-center-row absolute bottom-0">
    <div class="carousel-dots p-2">
        @foreach($items as $index => $slide)
            <div class="carousel-dot p-2 {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></div>
        @endforeach
    </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('carousel');
        const slides = carousel.querySelectorAll('.carousel-item');
        const dots = carousel.querySelectorAll('.carousel-dot');
        const totalSlides = slides.length;
        let currentSlide = 0;
        let startX, moveX;
        let isMouseDown = false;

        function showSlide(index) {
            slides[currentSlide].classList.remove('active');
            dots[currentSlide].classList.remove('active');
            currentSlide = (index + totalSlides) % totalSlides;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }

        carousel.addEventListener('click', function(e) {
            if (e.target.classList.contains('carousel-dot')) {
                const index = parseInt(e.target.getAttribute('data-index'));
                showSlide(index);
            }
        });

        // Mouse swipe functionality
        carousel.addEventListener('mousedown', function(e) {
            isMouseDown = true;
            startX = e.pageX;
            this.style.cursor = 'grabbing';
        });

        carousel.addEventListener('mousemove', function(e) {
            if (!isMouseDown) return;
            moveX = e.pageX;
            const diff = moveX - startX;
            if (Math.abs(diff) > 50) { // Threshold for swipe
                if (diff > 0) {
                    showSlide(currentSlide + 1); // Inverted: swipe right to go to next slide
                } else {
                    showSlide(currentSlide - 1); // Inverted: swipe left to go to previous slide
                }
                isMouseDown = false;
                this.style.cursor = 'grab';
            }
        });

        carousel.addEventListener('mouseup', function() {
            isMouseDown = false;
            this.style.cursor = 'grab';
        });

        carousel.addEventListener('mouseleave', function() {
            isMouseDown = false;
            this.style.cursor = 'grab';
        });

        // Prevent default drag behavior
        carousel.addEventListener('dragstart', function(e) {
            e.preventDefault();
        });

        // Auto-advance slides every 5 seconds
        let autoAdvance = setInterval(() => {
            showSlide(currentSlide + 1);
        }, 4000);

        // Pause auto-advance on mouse enter, resume on mouse leave
        carousel.addEventListener('mouseenter', function() {
            clearInterval(autoAdvance);
        });

        carousel.addEventListener('mouseleave', function() {
            autoAdvance = setInterval(() => {
                showSlide(currentSlide + 1);
            }, 4000);
        });
    });
</script> -->
<style>
    .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            opacity: 0.65;
            border-radius: 50%;
            background-color: oklch(var(--b1));
            margin: 0 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
    .swiper-pagination-bullet-active {
        background-color: oklch(var(--p));
        padding-left: 15px;
        opacity: 1;
        padding-right: 15px;
        border-radius: 10px;
    }
</style>
<div class="bg-base-100 md:w-[77%!important] w-full">
    <div style="width:100% !important; padding:0 !important;" class="w-full rounded-box ccontainer m-auto flex items-center justify-center h-[14em] sm:h-[18em] md:h-[20em!important]">
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
            // autoplay: {
            //     delay: 4000,
            //     disableOnInteraction: false
            // },
            pagination: {
                el: ".swiper-pagination",
            },
            modules: [ Pagination, Autoplay ],
        });
    })
</script>
@endpush