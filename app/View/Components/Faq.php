<?php

namespace App\View\Components;

use Closure;
use Corcel\Model\Post;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

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
        // Adjust this query based on your needs
        return Post::type('faqs')->status('publish')->get();
    }
}
