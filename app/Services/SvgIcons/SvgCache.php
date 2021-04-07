<?php


namespace App\Services\SvgIcons;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SvgCache implements SvgCacheable
{
    public function get()
    {
        return Cache::rememberForever($this->getCacheKey(), function () {
            return DB::table('svgs')->select('id','name','markup')
                ->get();
        });
    }

    protected function getCacheKey()
    {
        return 'svg-icons';
    }
}
