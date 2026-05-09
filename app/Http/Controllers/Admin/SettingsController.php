<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Show operating hours settings
     */
    public function operatingHours()
    {
        $settings = [
            'weekday_open' => ShopSetting::get('weekday_open', '08:00'),
            'weekday_close' => ShopSetting::get('weekday_close', '15:00'),
            'saturday_open' => ShopSetting::get('saturday_open', '08:00'),
            'saturday_close' => ShopSetting::get('saturday_close', '13:00'),
            'sunday_closed' => ShopSetting::get('sunday_closed', '1'),
        ];

        return view('admin.settings.operating-hours', compact('settings'));
    }

    /**
     * Update operating hours settings
     */
    public function updateOperatingHours(Request $request)
    {
        $request->validate([
            'weekday_open' => 'required|date_format:H:i',
            'weekday_close' => 'required|date_format:H:i',
            'saturday_open' => 'required|date_format:H:i',
            'saturday_close' => 'required|date_format:H:i',
            'sunday_closed' => 'required|in:0,1',
        ]);

        ShopSetting::set('weekday_open', $request->weekday_open);
        ShopSetting::set('weekday_close', $request->weekday_close);
        ShopSetting::set('saturday_open', $request->saturday_open);
        ShopSetting::set('saturday_close', $request->saturday_close);
        ShopSetting::set('sunday_closed', $request->sunday_closed);

        return redirect()->route('admin.settings.operating-hours')
            ->with('success', 'Jam operasional berhasil diperbarui!');
    }

    /**
     * Get operating hours for API (used by frontend)
     */
    public function getOperatingHours()
    {
        return response()->json([
            'weekday_open' => ShopSetting::get('weekday_open', '08:00'),
            'weekday_close' => ShopSetting::get('weekday_close', '15:00'),
            'saturday_open' => ShopSetting::get('saturday_open', '08:00'),
            'saturday_close' => ShopSetting::get('saturday_close', '13:00'),
            'sunday_closed' => ShopSetting::get('sunday_closed', '1') === '1',
        ]);
    }
}
