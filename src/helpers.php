<?php

use Illuminate\Support\Facades\URL;

if ( ! function_exists('admin_url') ) {
    function admin_url($path = null, $extra = [], $secure = null) {
        return URL::admin($path, $extra, $secure);
    }
}

if ( ! function_exists('admin_path') ) {
    function admin_path($path = null) {
        $prefix = trim(config('admin.path', 'admin'), '/');
        return rtrim($prefix.'/'.$path, '/');
    }
}

if (!function_exists('admin_redirect')) {
    function admin_redirect($to = null, $status = 302, $headers = [], $secure = null)
    {
        return redirect(admin_path($to), $status, $headers, $secure);
    }
}

if ( ! function_exists('adminUser') ) {
    function adminUser() {
        return request()->user('admin');
    }
}
