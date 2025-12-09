<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\ContactInfo;
use App\Models\SocialMedia;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        // Create profile if doesn't exist
        if (!$user->profile) {
            $profile = Profile::create([
                'user_id' => $user->id,
                'banner_image' => 'banners/default-banner.jpg',
                'profile_image' => 'profiles/default-avatar.jpg',
                'theme' => 'modern',
            ]);

            // Create default contact info
            $profile->contactInfos()->create([
                'type' => 'mobile',
                'value' => '+971 50 123 4567'
            ]);

            $profile->contactInfos()->create([
                'type' => 'email',
                'value' => 'hello@example.com'
            ]);

            // Create default social media
            $profile->socialMedia()->create([
                'platform' => 'instagram',
                'url' => 'https://instagram.com/yourprofile'
            ]);
            
            // Load the profile with relationships
            $profile = $profile->load(['contactInfos', 'socialMedia', 'products']);
        } else {
            // Load the existing profile with relationships
            $profile = $user->profile->load(['contactInfos', 'socialMedia', 'products']);
            
            // Ensure theme is set, default to 'modern' if not
            if (!$profile->theme || !in_array($profile->theme, ['modern', 'classic', 'minimal', 'dark', 'colorful'])) {
                $profile->theme = 'modern';
                $profile->save();
            }
        }
        $contacts = $profile->contactInfos->count() > 0 ? $profile->contactInfos : collect([]);
        $socials = $profile->socialMedia->count() > 0 ? $profile->socialMedia : collect([]);
        $products = $profile->products->count() > 0 ? $profile->products : collect([]);

        return view('profile.edit', compact(
            'profile',
            'contacts',
            'socials',
            'products',
            'user'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'alpha_dash', 'min:3', 'unique:users,username,' . Auth::id()],
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'theme' => 'nullable|string|in:modern,classic,minimal,dark,colorful',
            'contacts' => 'nullable|array',
            'contacts.*.type' => 'required_with:contacts.*|in:mobile,whatsapp,email,website,telegram',
            'contacts.*.value' => 'required_with:contacts.*|string|max:255',
            'socials' => 'nullable|array',
            'socials.*.platform' => 'required_with:socials.*|in:instagram,facebook,twitter,linkedin,youtube,tiktok',
            'socials.*.url' => 'required_with:socials.*|nullable|url',
            'products' => 'nullable|array',
            'products.*.name' => 'nullable|string|max:255',
            'products.*.description' => 'nullable|string',
            'products.*.price' => 'nullable|numeric|min:0',
            'products.*.featured' => 'nullable|boolean',
            'products.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $user->update(['username' => $request->username]);

        // Ensure profile exists
        if (!$user->profile) {
            $profile = Profile::create([
                'user_id' => $user->id,
                'banner_image' => 'banners/default-banner.jpg',
                'profile_image' => 'profiles/default-avatar.jpg',
                'location' => $request->location ?? 'Dubai, UAE',
                'theme' => $request->theme ?? 'modern',
            ]);
        } else {
            $profile = $user->profile;
        }

        // Prepare update data
        $updateData = $request->only(['location', 'company', 'position', 'bio']);
        
        // Always update theme if provided, otherwise keep existing theme
        if ($request->has('theme') && !empty($request->theme)) {
            $updateData['theme'] = $request->theme;
        }

        // Handle banner image
        if ($request->hasFile('banner_image')) {
            // Delete old banner image if it exists and is not default
            if ($profile->banner_image && Storage::disk('public')->exists($profile->banner_image) && !Str::contains($profile->banner_image, 'default-banner')) {
                Storage::disk('public')->delete($profile->banner_image);
            }
            
            // Resize and save banner image (1200x400)
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('banner_image')->getRealPath());
            $image->cover(1200, 400);
            $bannerPath = 'banners/' . Str::random(40) . '.' . $request->file('banner_image')->getClientOriginalExtension();
            $fullPath = Storage::disk('public')->path($bannerPath);
            Storage::disk('public')->makeDirectory('banners');
            $image->save($fullPath, quality: 85);
            $updateData['banner_image'] = $bannerPath;
        }

        // Handle profile image
        if ($request->hasFile('profile_image')) {
            // Delete old profile image if it exists and is not default
            if ($profile->profile_image && Storage::disk('public')->exists($profile->profile_image) && !Str::contains($profile->profile_image, 'default-avatar')) {
                Storage::disk('public')->delete($profile->profile_image);
            }
            
            // Resize and save profile image (400x400 square)
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('profile_image')->getRealPath());
            $image->cover(400, 400);
            $profilePath = 'profiles/' . Str::random(40) . '.' . $request->file('profile_image')->getClientOriginalExtension();
            $fullPath = Storage::disk('public')->path($profilePath);
            Storage::disk('public')->makeDirectory('profiles');
            $image->save($fullPath, quality: 85);
            $updateData['profile_image'] = $profilePath;
        }

        // Update profile with all data including images
        $profile->update($updateData);
        
        // Refresh the profile to get the latest data
        $profile->refresh();

        // Update contact information - only update if we have valid data
        if ($request->has('contacts') && is_array($request->contacts)) {
            $validContacts = [];
            foreach ($request->contacts as $contact) {
                if (!empty($contact['type']) && !empty($contact['value']) && 
                    $contact['value'] !== 'default@example.com' && 
                    trim($contact['value']) !== '') {
                    $validContacts[] = [
                        'type' => $contact['type'],
                        'value' => trim($contact['value'])
                    ];
                }
            }
            // Only update if we have at least one valid contact
            // This prevents clearing all contacts when form has empty fields
            if (count($validContacts) > 0) {
                $profile->contactInfos()->delete();
                foreach ($validContacts as $contact) {
                    $profile->contactInfos()->create($contact);
                }
            }
            // If all contacts are empty, preserve existing data
        }

        // Update social media - only update if we have valid data
        if ($request->has('socials') && is_array($request->socials)) {
            $validSocials = [];
            foreach ($request->socials as $social) {
                if (!empty($social['platform']) && !empty($social['url']) && 
                    $social['url'] !== '#' && 
                    trim($social['url']) !== '') {
                    $validSocials[] = [
                        'platform' => $social['platform'],
                        'url' => trim($social['url'])
                    ];
                }
            }
            // Only update if we have at least one valid social
            if (count($validSocials) > 0) {
                $profile->socialMedia()->delete();
                foreach ($validSocials as $social) {
                    $profile->socialMedia()->create($social);
                }
            }
            // If all socials are empty, preserve existing data
        }

        // Update products - only update if we have valid products to save
        if ($request->has('products') && is_array($request->products)) {
            $validProducts = [];
            
            // Get existing products and their images (by position/index)
            // Ensure products are loaded and reset keys to 0,1,2...
            $existingProducts = $profile->products()->get()->values();
            
            foreach ($request->products as $index => $productData) {
                // Skip if productData is not an array
                if (!is_array($productData)) continue;
                
                // A product is valid if it has at least a name or description
                $name = isset($productData['name']) ? trim($productData['name']) : '';
                $description = isset($productData['description']) ? trim($productData['description']) : '';
                $hasName = !empty($name);
                $hasDescription = !empty($description);
                
                if ($hasName || $hasDescription) {
                    // Preserve existing image if available (match by position/index)
                    $existingImage = null;
                    if (isset($existingProducts[$index]) && $existingProducts[$index]->image) {
                        $existingImage = $existingProducts[$index]->image;
                    }
                    
                    $validProducts[] = [
                        'index' => $index,
                        'existing_image' => $existingImage,
                        'data' => [
                            'name' => $name,
                            'description' => $description,
                            'price' => isset($productData['price']) && $productData['price'] !== '' ? $productData['price'] : null,
                            'featured' => isset($productData['featured']) ? (bool)$productData['featured'] : false,
                        ]
                    ];
                }
            }
            
            // Only update if we have at least one valid product
            // This prevents clearing all products when form has empty fields
            if (count($validProducts) > 0) {
                // Store all existing images for cleanup later (use the already loaded existingProducts)
                $allExistingImages = [];
                foreach ($existingProducts as $existingProduct) {
                    if ($existingProduct->image && !Str::contains($existingProduct->image, 'default-property')) {
                        $allExistingImages[] = $existingProduct->image;
                    }
                }
                
                $profile->products()->delete();
                
                // Track which images are still in use
                $imagesInUse = [];
                
                foreach ($validProducts as $productItem) {
                    $index = $productItem['index'];
                    $productData = $productItem['data'];
                    $existingImage = $productItem['existing_image'];
                    
                    // Ensure product has at least a name (required by database)
                    $productName = !empty($productData['name']) 
                        ? $productData['name'] 
                        : 'Product ' . ($index + 1);
                    
                    // Preserve existing image if no new file is uploaded
                    $productImage = 'products/default-property.jpg';
                    if ($request->hasFile("products.$index.image")) {
                        // New file will be uploaded, will set after creation
                    } elseif ($existingImage) {
                        // Use existing image if available
                        $productImage = $existingImage;
                        $imagesInUse[] = $existingImage;
                    }
                    
                    $product = $profile->products()->create([
                        'name' => $productName,
                        'description' => !empty($productData['description']) ? $productData['description'] : null,
                        'price' => $productData['price'],
                        'featured' => $productData['featured'],
                        'image' => $productImage
                    ]);

                    // Handle new image upload
                    if ($request->hasFile("products.$index.image")) {
                        // Delete old image if it exists and is not default
                        if ($product->image && !Str::contains($product->image, 'default-property')) {
                            Storage::disk('public')->delete($product->image);
                        }
                        
                        // Resize and save product image (600x400)
                        $manager = new ImageManager(new Driver());
                        $image = $manager->read($request->file("products.$index.image")->getRealPath());
                        $image->cover(600, 400);
                        $imagePath = 'products/' . Str::random(40) . '.' . $request->file("products.$index.image")->getClientOriginalExtension();
                        $fullPath = Storage::disk('public')->path($imagePath);
                        Storage::disk('public')->makeDirectory('products');
                        $image->save($fullPath, quality: 85);
                        $product->image = $imagePath;
                        $product->save();
                    }
                }
                
                // Clean up orphaned images (images not used by any product)
                foreach ($allExistingImages as $oldImage) {
                    if (!in_array($oldImage, $imagesInUse) && Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }
            // If all products are empty, preserve existing data
        }

        return redirect()->route('profile.edit')
            ->with('success', 'Your business card has been updated successfully!');
    }
}
