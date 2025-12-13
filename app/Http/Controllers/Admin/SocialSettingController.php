<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialSetting;
use Illuminate\Http\Request;

class SocialSettingController extends Controller
{
    /**
     * Display the social settings form.
     */
    public function index()
    {
        $setting = SocialSetting::first();
        
        // If no setting exists, create a default one
        if (!$setting) {
            $setting = SocialSetting::create([
                'is_active' => true,
            ]);
        }
        
        return view('admin.social-settings.index', compact('setting'));
    }

    /**
     * Update the social settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'bio' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $setting = SocialSetting::first();
        
        if (!$setting) {
            $setting = SocialSetting::create($request->only([
                'phone', 'whatsapp', 'email', 'facebook', 'instagram', 'twitter',
                'linkedin', 'youtube', 'tiktok', 'bio', 'is_active'
            ]));
        } else {
            $setting->update($request->only([
                'phone', 'whatsapp', 'email', 'facebook', 'instagram', 'twitter',
                'linkedin', 'youtube', 'tiktok', 'bio', 'is_active'
            ]));
        }

        return redirect()->route('admin.social-settings.index')
            ->with('success', 'Social settings updated successfully!');
    }
}
