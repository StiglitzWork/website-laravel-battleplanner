<?php
/**
 * Creates a URL using a relative path
 */
function r_asset($url)
{
    if (file_exists(public_path($url))) {
        return "/$url";
    } else {
        throw new Illuminate\Contracts\Filesystem\FileNotFoundException($url);
    }
}
