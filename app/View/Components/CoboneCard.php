<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CoboneCard extends Component
{
    /**
     * Create the component instance.
     */
    public function __construct(
        public $title,
        public $code,
        public $index,
        public string|null $desc,
        public $type,
        public string|null $link,
        public $store,
        public int $id
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cobone-card');
    }
}
