<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SvgIcons\SvgCacheable;
use Illuminate\Http\JsonResponse;

class SvgsController extends Controller
{
    /**
     * @param  SvgCacheable  $svgCacheable
     * @return JsonResponse
     */
    public function __invoke(SvgCacheable $svgCacheable): JsonResponse
    {
        return response()->json([
            'svgs' => $svgCacheable->get()
        ]);
    }
}
