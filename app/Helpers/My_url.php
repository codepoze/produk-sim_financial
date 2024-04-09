<?php

// untuk akses assets admin
if (!function_exists('asset_admin')) {
    function asset_admin($path)
    {
        return asset("assets/admin/{$path}");
    }
}

// untuk akses assets pages
if (!function_exists('asset_pages')) {
    function asset_pages($path)
    {
        return asset("assets/pages/{$path}");
    }
}

// untuk akses upload file
if (!function_exists('asset_upload')) {
    function asset_upload($path)
    {
        return asset("uploads/{$path}");
    }
}

// untuk lokasi upload file
if (!function_exists('upload_path')) {
    function upload_path($path)
    {
        return public_path("uploads/{$path}");
    }
}
