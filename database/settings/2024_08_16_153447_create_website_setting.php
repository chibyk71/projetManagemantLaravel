<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add("website.front_page_heading","");
        $this->migrator->add("website.front_page_subheading","");
        $this->migrator->add("website.mission","");
        $this->migrator->add("website.about_img","");
        $this->migrator->add("website.front_img","");
    }
};
