<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class WebsiteSetting extends Settings
{

    public string $front_page_heading;
    public string $front_page_subheading;

    public string $mission;
    public string $front_img;
    public string $about_img;

    public string $large_logo;

    public string $small_logo;

    public static function group(): string
    {
        return 'website';
    }
}