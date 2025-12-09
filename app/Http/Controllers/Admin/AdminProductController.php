<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminProductController extends Controller
{
    /**
     * Display a listing of admin products.
     */
    public function index()
    {
        $products = AdminProduct::latest()->paginate(15);
        return view('admin.admin-products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('admin.admin-products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'featured' => 'boolean',
            'stock_quantity' => 'nullable|integer|min:0',
            'features' => 'nullable|string',
        ]);

        $productData = [
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'is_active' => $request->has('is_active') ? true : false,
            'featured' => $request->has('featured') ? true : false,
            'stock_quantity' => $validated['stock_quantity'] ?? null,
            'features' => $validated['features'] ?? null,
        ];

        $product = AdminProduct::create($productData);

        // Handle image upload
        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image')->getRealPath());
            $image->cover(600, 400);
            $imagePath = 'admin-products/' . Str::random(40) . '.' . $request->file('image')->getClientOriginalExtension();
            $fullPath = Storage::disk('public')->path($imagePath);
            Storage::disk('public')->makeDirectory('admin-products');
            $image->save($fullPath, quality: 85);
            $product->image = $imagePath;
            $product->save();
        }

        return redirect()->route('admin.admin-products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = AdminProduct::findOrFail($id);
        return view('admin.admin-products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $product = AdminProduct::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'featured' => 'boolean',
            'stock_quantity' => 'nullable|integer|min:0',
            'features' => 'nullable|string',
        ]);

        $product->name = $validated['name'];
        $product->slug = Str::slug($validated['name']);
        $product->description = $validated['description'] ?? null;
        $product->price = $validated['price'];
        $product->is_active = $request->has('is_active') ? true : false;
        $product->featured = $request->has('featured') ? true : false;
        $product->stock_quantity = $validated['stock_quantity'] ?? null;
        $product->features = $validated['features'] ?? null;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image')->getRealPath());
            $image->cover(600, 400);
            $imagePath = 'admin-products/' . Str::random(40) . '.' . $request->file('image')->getClientOriginalExtension();
            $fullPath = Storage::disk('public')->path($imagePath);
            Storage::disk('public')->makeDirectory('admin-products');
            $image->save($fullPath, quality: 85);
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('admin.admin-products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = AdminProduct::findOrFail($id);

        // Delete image if exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.admin-products.index')
            ->with('success', 'Product deleted successfully!');
    }
}

