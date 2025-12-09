<?php

namespace App\Http\Controllers;

use App\Models\AdminProduct;
use Illuminate\Http\Request;

class PublicProductController extends Controller
{
    /**
     * Display all products (NFC Cards) for public viewing.
     */
    public function index()
    {
        $products = AdminProduct::where('is_active', true)
            ->orderBy('featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        return view('products.all', compact('products'));
    }
}

