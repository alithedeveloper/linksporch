<?php

if (!function_exists('bio_url')) {
    /**
     * @param $username
     * @param $slug
     * @return string
     */
    function bio_url($username, $slug): string
    {
        return config('app.url')."/{$username}/{$slug}";
    }
}
