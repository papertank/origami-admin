<?php

namespace Origami\Admin;

class Admin {

    const VERSION = '3.x-dev';

    public function cssAssets()
    {
        $adminCssPath = mix('css/admin.css', 'vendor/admin');
        return <<<HTML
<link href="{$adminCssPath}" rel="stylesheet">
HTML;
    }

    public function javascriptAssets()
    {
        $vendorJsPath = mix('js/vendor.js', 'vendor/admin');
        $adminJsPath = mix('js/admin.js', 'vendor/admin');
        return <<<HTML
<script src="{$vendorJsPath}"></script>
<script src="{$adminJsPath}"></script>
HTML;
    }

}
