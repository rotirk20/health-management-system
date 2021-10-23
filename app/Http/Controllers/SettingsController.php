<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function index() {
        $settings = DB::table('settings')->first();
        return view('admin.settings.settings', ['settings' => $settings]);
    }

    public function saveSettings(Request $request) {
        $settings = $request->except('_token');
        $settingsSaved = DB::table('settings')
        ->where('id', 1)
        ->update($settings);
        return redirect('settings')->with('success', 'Settings successfully added.');
    }
}
