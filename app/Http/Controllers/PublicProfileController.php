<?php

namespace App\Http\Controllers;

use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PublicProfileController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $profile = $user->profile;
        
        // Load profile with relationships
        if ($profile) {
            $profile->load(['contactInfos', 'socialMedia', 'products']);
        }
        
        $qrcode = QrCode::size(250)->generate(url($username));

        return view('public.profile', compact('user', 'profile', 'qrcode'));
    }
}
