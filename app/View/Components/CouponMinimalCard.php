<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CouponMinimalCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public string $code,
        public string $created,
        public string|null $desc,
        public $type,
        public string|null $link,
        public $image,
        public $value,
        public $store,
        public int $id
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.coupon-minimal-card');
    }
}
