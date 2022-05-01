<?php

namespace App\Http\Controllers\Backend;

use App\Models\SiteSetting;
// adaugam clasa de lucru cu imagini din Image Intervention Package
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteSettingController extends Controller
{
    public function SiteSetting()
    {
        // $site_setting primeste toate datele din tabela site_setting folosind modelul SiteSetting si functia first()
        $setting = SiteSetting::find(1);
        // returnam view-ul setting_update.blade.php si trimitem ca parametru $setting
        return view('backend.setting.setting_update', compact('setting'));
    }
}