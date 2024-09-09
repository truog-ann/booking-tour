<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    //
    public function index()
    {
        $banners = Banner::with('images')->get();
        return view('banners.index', compact('banners'));
    }

    // Create
    public function create()
    {
        return view('banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $banner = Banner::create([
            'title' => $request->title,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('banner_images', 'public');
                BannerImages::create([
                    'banner_id' => $banner->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('banners.index')
                        ->with('success', 'Banner created successfully.');
    }

    // Read (Show)
    public function show(Banner $banner)
    {
        $banner->load('images');
        return view('banners.show', compact('banner'));
    }

    // Update
    public function edit(Banner $banner)
    {
        $banner->load('images');
        return view('banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required',
            'images' => 'nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $banner->update([
            'title' => $request->title,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('banner_images', 'public');
                BannerImages::create([
                    'banner_id' => $banner->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('banners.index')
                        ->with('success', 'Banner updated successfully');
    }

    // Delete
    public function destroy(Banner $banner)
    {
        foreach ($banner->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        $banner->delete();

        return redirect()->route('banners.index')
                        ->with('success', 'Banner deleted successfully');
    }
}
