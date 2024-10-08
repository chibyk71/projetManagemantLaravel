<?php

namespace App\Http\Controllers;

use App\Settings\GeneralSetting;
use App\Settings\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use RahulHaque\Filepond\Facades\Filepond;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function generalShow(GeneralSetting $setting)
    {
        return Inertia::render("Dashboard/Settings/General/Page",
    [
        "timezone" =>  $setting->timezone,
        "date_format" => $setting->date_format,
        "close_modal_on_page_click" => $setting->close_modal_on_page_click,
        "pagination" => $setting->pagination,
    ]
);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function generalStore(Request $request, GeneralSetting $setting)
    {
        $validated = $request->validate([
            "timezone" => "sometimes|string",
            "date_format" => "sometimes|string",
            "close_modal_on_page_click" => "boolean|sometimes",
            "pagination" => "sometimes",
        ]);

        foreach ($validated as $key => $value) {
            if ($value !== null) {
                $setting->$key = $value;
            }
        }

        $setting->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function websiteShow(WebsiteSetting $setting)
    {
        return Inertia::render("Dashboard/Settings/Website/Page",
    [
        "front_page_heading" =>  $setting->front_page_heading,
        "front_page_subheading" => $setting->front_page_subheading,
        "mission" => $setting->mission,
        "about_img" => $setting->about_img,
        "front_img" => $setting->front_img,
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function websiteStore(Request $request, WebsiteSetting $websiteSetting)
    {
        $validated = $request->validate([
            "front_page_heading" =>  "sometimes|string",
            "front_page_subheading" => "sometimes|string",
            "mission" => "sometimes|string",
            "about_img" => "sometimes|string|nullable",
            "front_img" => "sometimes|string|nullable",
            "large_logo" => "sometimes|string|nullable",
            "small_logo"=> "sometimes|string|nullable"
        ]);

        $images = ["large_logo","small_logo","front_img","about_img"];

        foreach ($validated as $key => $value) {
            if (in_array($key,$images) && $value != null) {
                $infos = Filepond::field($value)->moveTo("logo/".$key);
                $value = $infos["location"];
            }

            if ($value !== null) {
                $websiteSetting->$key = $value;
            }
        }

        $websiteSetting->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function companyShow(string $id)
    {
        //
    }

    public function companyStore(string $id)
    {
        //
    }
}
