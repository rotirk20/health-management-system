<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{

    public function create_time_range($start, $end, $interval = '30 mins', $format = '12')
    {
        $startTime = strtotime($start);
        $endTime   = strtotime($end);
        $returnTimeFormat = ($format == '12') ? 'g:i A' : 'G:i';

        $current   = time();
        $addTime   = strtotime('+' . $interval, $current);
        $diff      = $addTime - $current;

        $times = array();
        while ($startTime < $endTime) {
            $times[] = date($returnTimeFormat, $startTime);
            $startTime += $diff;
        }
        $times[] = date($returnTimeFormat, $startTime);
        return $times;
    }

    public function index()
    {
        $settings = DB::table('settings')->first();
        $times = $this->create_time_range($settings->start_time, $settings->end_time, $settings->interval, $settings->format);
        return view('admin.settings.settings', ['settings' => $settings, 'times' => $times]);
    }

    public function saveSettings(Request $request)
    {
        $validated = $request->validate([
            'start_time' => 'required',
            'end_time' => 'required',
            'interval' => 'required',
            'format' => 'required'
        ]);
        if ($request->file('logo_path') != null) {
            $image = $request->file('logo_path');
            $imageName = $image->getClientOriginalName();
            $logo_path = public_path('storage/images/logo') . '' . $imageName;
            $image->move(public_path('storage/images/logo'), $imageName);
        }

        $settings = $request->except(['_token', 'logo_path']);
        $settingsSaved = DB::table('settings')
            ->where('id', 1)
            ->update($settings);
        DB::table('settings')
            ->where('id', 1)
            ->update(['logo_path' => $imageName]);
        return redirect('settings')->with('success', 'Settings successfully added.');
    }
}
