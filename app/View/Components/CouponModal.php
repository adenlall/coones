<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CouponModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $id,
        public $store,
        public string $title,
        public string $code,
        public string|null $desc,
        public string|null $link,
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.coupon-modal');
    }
}
