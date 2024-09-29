<?php

namespace App\Models;

use Carbon\Carbon;

use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Corcel\Model\Meta\ThumbnailMeta;
use Corcel\Model\Post as Corcel;

class Post extends Corcel implements Sitemapable
{
    public function toSitemapTag(): Url | string | array
    {
        if ($this->post_type === 'stores') {
            $url = route('store.single', $this->_store_name);
        } else {
            dd($this->post_type);
        }
        return Url::create($url)
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
    }
}