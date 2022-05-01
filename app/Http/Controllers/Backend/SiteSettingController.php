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

    // functia de actualizare date comapnie pe site
    public function SiteSettingUpdate(Request $request)
    {
        // Setting_id preia id-ul din campul ascuns din formularul de actualizare
        $setting_id = $request->id;

        // daca avem imagine in campul logo actualizam datele in tabela site_setting
        if ($request->file('logo')) {
            // $image primeste imaginea din campul logo din formularul de actualizare
            $image = $request->file('logo');
            // $name_gen primeste un nume generat random pentru imaginea din campul logo din formularul de actualizare
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            // salvam imaginea in folderul public/images/logo la o anumita rezolutie
            Image::make($image)->resize(80, 80)->save('upload/logo/' . $name_gen);
            // $save_url primeste adresa de salvare a imaginii din campul logo din formularul de actualizare
            $save_url = 'upload/logo/' . $name_gen;

            // actualizam datele in tabela site_setting
            SiteSetting::findOrFail($setting_id)->update([
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
                'logo' => $save_url,
            ]);
            // mesaj de notificare
            $notification = array(
                'message' => 'Datele companiei au fost actualizate cu succes!',
                'alert-type' => 'info'
            );
            // redirectionam inapoi la pagina de actualizare date companie cu notificare
            return redirect()->back()->with($notification);
        }
        // daca nu avem imagine la log actualizam toate campurile din tabela site_setting (fara poza)
        else {
            // actualizam datele in tabela site_setting
            SiteSetting::findOrFail($setting_id)->update([
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
            ]);

            // mesaj de notificare
            $notification = array(
                'message' => 'Datele companiei au fost actualizate cu succes!',
                'alert-type' => 'info'
            );
            // redirectionam inapoi la pagina de actualizare date companie cu notificare
            return redirect()->back()->with($notification);
        }
    }
}