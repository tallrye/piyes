<?php

namespace App\Http\Controllers\Piyes;

use Illuminate\Http\Request;
use App\Models\Piyes\User\Setting;
use Image;
use File;

class UserProfileController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Change the settings
     *
     * @return \Illuminate\Http\Response
     */
    public function changeSettings(Request $request)
    {
        $settings = auth()->user()->settings;
        ($request->showNotifications) ? $settings->showNotifications = true : $settings->showNotifications = false;
        ($request->isSidebarClosed) ? $settings->isSidebarClosed = true : $settings->isSidebarClosed = false;
        ($request->language) ? $settings->language = "en" : $settings->language = "tr";
        $settings->save();
        session()->flash('success', 'Settings has changed.');
        return redirect('/'.$settings->language.'/piyes/home');
    }

    /**
     * Show the page for changing profile photo
     *
     * @return \Illuminate\Http\Response
     */
    public function changeProfilePhoto(Request $request)
    {
        return view('piyes.profile.change-profile-photo');
    }

    /**
     * Store new profile photo
     *
     * @return \Illuminate\Http\Response
     */
    public function storeProfilePhoto(Request $request)
    {
        $settings = auth()->user()->settings;
        $output = str_replace(parent::$turkish, parent::$english, auth()->user()->name);
        if($request->get('theFile')){
            File::delete(public_path('storage/profile-photos/'.$settings->profile_photo));
            $filename = time().parent::seo_friendly_url($output);
            $x = round($request->get('x'));
            $y = round($request->get('y'));
            $w = round($request->get('w'));
            $h = round($request->get('h'));
            $image = Image::make($request->get('theFile'));
            $mime = $image->mime();
            if ($mime == 'image/jpeg'){
                $extension = '.jpg';
            }
            elseif ($mime == 'image/png'){
                $extension = '.png';
            }
            else{
                session()->flash('danger', 'You can only upload .png or .jpg files');
                return redirect()->back();
            }
            $image->crop($w, $h, $x, $y)->save(public_path('storage/profile-photos/'.$filename.$extension));
            $settings->profile_photo = $filename.$extension;
        }
        $settings->save();
        session()->flash('success', 'Profile photo has been changed.');
        return redirect()->back();
    }
    
}
