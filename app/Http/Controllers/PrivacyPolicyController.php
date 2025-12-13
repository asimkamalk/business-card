<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function privacy()
    {
        return view('privacy');
    }

    public function policy()
    {
        return view('policy');
    }
}
