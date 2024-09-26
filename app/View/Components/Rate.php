<?php

namespace App\View\Components;

use App\Models\Review;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;

class Rate extends Component
{
    public $items;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $id,
        public $store,
    )
    {
        error_log($store);
        $this->items = $this->getFaqItems($store);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.rate');
    }

    /**
     * Fetch Faq items from the database.
     */
    private function getFaqItems($store)
    {
        $store = $this->store;
        $percentage = Cache::remember('slides', 5000, function () use($store) {
            $totalReviews = Review::where('storeName', $store)->count();
            $positiveReviews = Review::where('storeName', $store)
                ->where('review', '1')
                ->count();
            $percentage = $totalReviews > 0 ? ($positiveReviews / $totalReviews) * 100 : 0;
            return round($percentage);
        });
        return $percentage . '%';
    }
}
