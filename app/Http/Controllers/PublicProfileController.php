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
        
        // Generate QR code with https://itappdigital.com/username
        // Using SVG format which doesn't require imagick extension
        $profileUrl = 'https://itappdigital.com/' . $username;
        $qrcodeSvg = QrCode::size(250)->generate($profileUrl);

        return view('public.profile', compact('user', 'profile', 'qrcodeSvg', 'profileUrl'));
    }

    public function showProduct($username, $productId)
    {
        $user = User::where('username', $username)->firstOrFail();
        $profile = $user->profile;
        
        if (!$profile) {
            abort(404);
        }
        
        $product = $profile->products()->findOrFail($productId);
        $profile->load(['contactInfos', 'socialMedia']);
        
        // Generate QR code with https://itappdigital.com/username
        // Using SVG format which doesn't require imagick extension
        $profileUrl = 'https://itappdigital.com/' . $username;
        $qrcodeSvg = QrCode::size(250)->generate($profileUrl);

        return view('public.product', compact('user', 'profile', 'product', 'qrcodeSvg', 'profileUrl'));
    }

    public function downloadVCard($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $profile = $user->profile;
        
        if (!$profile) {
            abort(404);
        }
        
        // Load contact information
        $profile->load(['contactInfos']);
        
        // Extract contact information
        $phone = '';
        $email = '';
        $website = '';
        $whatsapp = '';
        
        foreach ($profile->contactInfos as $contact) {
            switch ($contact->type) {
                case 'mobile':
                    $phone = $contact->value;
                    break;
                case 'email':
                    $email = $contact->value;
                    break;
                case 'website':
                    $website = $contact->value;
                    break;
                case 'whatsapp':
                    $whatsapp = $contact->value;
                    break;
            }
        }
        
        // Generate vCard content
        $vcard = "BEGIN:VCARD\r\n";
        $vcard .= "VERSION:3.0\r\n";
        $vcard .= "FN:" . $this->escapeVCardValue($user->name) . "\r\n";
        $vcard .= "N:" . $this->escapeVCardValue($user->name) . ";;;;\r\n";
        
        if ($profile->company) {
            $vcard .= "ORG:" . $this->escapeVCardValue($profile->company) . "\r\n";
        }
        
        if ($profile->position) {
            $vcard .= "TITLE:" . $this->escapeVCardValue($profile->position) . "\r\n";
        }
        
        if ($phone) {
            $phoneClean = preg_replace('/[^0-9+]/', '', $phone);
            $vcard .= "TEL;TYPE=CELL:" . $phoneClean . "\r\n";
        }
        
        if ($whatsapp) {
            $whatsappClean = preg_replace('/[^0-9]/', '', $whatsapp);
            $vcard .= "TEL;TYPE=CELL;TYPE=WHATSAPP:" . $whatsappClean . "\r\n";
        }
        
        if ($email) {
            $vcard .= "EMAIL;TYPE=INTERNET:" . $this->escapeVCardValue($email) . "\r\n";
        }
        
        if ($website) {
            $websiteUrl = (strpos($website, 'http') === 0 ? '' : 'https://') . $website;
            $vcard .= "URL:" . $this->escapeVCardValue($websiteUrl) . "\r\n";
        }
        
        if ($profile->location) {
            $vcard .= "ADR;TYPE=WORK:;;" . $this->escapeVCardValue($profile->location) . ";;;\r\n";
        }
        
        if ($profile->bio) {
            $vcard .= "NOTE:" . $this->escapeVCardValue($profile->bio) . "\r\n";
        }
        
        // Add profile URL
        $profileUrl = 'https://itappdigital.com/' . $username;
        $vcard .= "URL:" . $profileUrl . "\r\n";
        
        $vcard .= "END:VCARD\r\n";
        
        // Generate filename
        $filename = str_replace(' ', '-', $user->name) . '-contact.vcf';
        
        // Return download response
        return response($vcard)
            ->header('Content-Type', 'text/vcard; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Content-Length', strlen($vcard));
    }
    
    private function escapeVCardValue($value)
    {
        // Escape special characters in vCard values
        $value = str_replace('\\', '\\\\', $value);
        $value = str_replace(',', '\\,', $value);
        $value = str_replace(';', '\\;', $value);
        $value = str_replace("\n", '\\n', $value);
        $value = str_replace("\r", '', $value);
        return $value;
    }
}
