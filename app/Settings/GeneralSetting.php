<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSetting extends Settings
{
    public string $timezone;
    public string $language;
    public string $date_format;
    public bool $close_modal_on_page_click;
    public int $pagination;
    
    public static function group(): string
    {
        return 'general';
    }
}