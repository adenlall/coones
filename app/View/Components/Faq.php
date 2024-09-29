<?php

namespace App\View\Components;

use Closure;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;

class Faq extends Component
{
    public $items;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = $this->getFaqItems();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.faq');
    }


    /**
     * Fetch Faq items from the database.
     */
    private function getFaqItems()
    {
        $faq_items = Cache::remember('faq_items', 300, function () {
            return Post::type('faqs')->status('publish')->get();
        });
        return $faq_items;
    }
}
