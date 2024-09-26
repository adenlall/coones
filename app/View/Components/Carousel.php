<?php

namespace App\View\Components;

use Closure;
use Corcel\Model\Post;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\CarouselItem; // Assuming you have a CarouselItem model
use Illuminate\Support\Facades\Cache;

class Carousel extends Component
{
    public $items;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = $this->getCarouselItems();
        // dd($this->items);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.carousel');
    }

    /**
     * Fetch carousel items from the database.
     */
    private function getCarouselItems()
    {
        $slides = Cache::remember('slides_items', 5000, function () {
            return Post::type('slides')->status('publish')->get();
        });
        // dd($slides);
        return $slides;
    }
}
