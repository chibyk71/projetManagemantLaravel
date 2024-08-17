<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add("general.timezone", "Africa/Lagos");
        $this->migrator->add("general.date_format", "m-d-y");
        $this->migrator->add("general.pagination", "50");
        $this->migrator->add("general.close_modal_on_page_click", "false");
    }
};
