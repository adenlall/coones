<?php
namespace App\View\Components;

use Closure;
use Corcel\Model\Post;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;

class Aside extends Component
{
    public $latest;
    public $top;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->latest = $this->getLastStores();
        $this->top = $this->getTopStores();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.aside');
    }
    /**
     * Get Last 5 store
     */
    private function getLastStores()
    {
        $lastStores = Cache::remember('last_stores', 300, function () {
            return Post::type('stores')->status('publish')->latest()->take(5)->get();
        });
        return $lastStores;
    }
    /**
     * Get Last 5 store
     */
    private function getTopStores()
    {
        $topStores = Cache::remember('top_stores', 300, function () {
            return Post::type('stores')
            ->status('publish')
            ->hasMeta('_store_pined', 'on')
            ->take(5)->get();
        });
        return $topStores;
    }
}
