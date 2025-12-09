<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $user = auth()->user();
        $profile = $user->profile;
        
        if (!$profile) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please create your profile first before adding products.');
        }
        
        $products = $profile->products()->latest()->get();
        
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $user = auth()->user();
        $profile = $user->profile;
        
        if (!$profile) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please create your profile first before adding products.');
        }
        
        return view('products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $profile = $user->profile;
        
        if (!$profile) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please create your profile first before adding products.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured' => 'boolean',
        ]);
        
        $productData = [
            'profile_id' => $profile->id,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'] ?? null,
            'featured' => $request->has('featured') ? true : false,
            'image' => 'products/default-property.jpg',
        ];
        
        $product = Product::create($productData);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image')->getRealPath());
            $image->cover(600, 400);
            $imagePath = 'products/' . Str::random(40) . '.' . $request->file('image')->getClientOriginalExtension();
            $fullPath = Storage::disk('public')->path($imagePath);
            Storage::disk('public')->makeDirectory('products');
            $image->save($fullPath, quality: 85);
            $product->image = $imagePath;
            $product->save();
        }
        
        return redirect()->route('products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::with('profile.user')->findOrFail($id);
        
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $user = auth()->user();
        $profile = $user->profile;
        
        if (!$profile) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please create your profile first.');
        }
        
        $product = Product::where('profile_id', $profile->id)->findOrFail($id);
        
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $profile = $user->profile;
        
        if (!$profile) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please create your profile first.');
        }
        
        $product = Product::where('profile_id', $profile->id)->findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured' => 'boolean',
        ]);
        
        $product->name = $validated['name'];
        $product->description = $validated['description'] ?? null;
        $product->price = $validated['price'] ?? null;
        $product->featured = $request->has('featured') ? true : false;
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists and is not default
            if ($product->image && !Str::contains($product->image, 'default-property')) {
                Storage::disk('public')->delete($product->image);
            }
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image')->getRealPath());
            $image->cover(600, 400);
            $imagePath = 'products/' . Str::random(40) . '.' . $request->file('image')->getClientOriginalExtension();
            $fullPath = Storage::disk('public')->path($imagePath);
            Storage::disk('public')->makeDirectory('products');
            $image->save($fullPath, quality: 85);
            $product->image = $imagePath;
        }
        
        $product->save();
        
        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $profile = $user->profile;
        
        if (!$profile) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please create your profile first.');
        }
        
        $product = Product::where('profile_id', $profile->id)->findOrFail($id);
        
        // Delete image if it exists and is not default
        if ($product->image && !Str::contains($product->image, 'default-property')) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();
        
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
