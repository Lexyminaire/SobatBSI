<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'required|boolean',
        ]);

        $path = $request->file('thumbnail')->store('thumbnails', 'public');

        $menu = new Menu();
        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->thumbnail = $path;
        $menu->is_available = $request->is_available;
        $menu->save();

        return redirect()->route('admin.menu.index')->with('success', 'Menu item created successfully.');

        // Menu::create($request->all());
        // return redirect()->route('admin.menu.index')->with('success', 'Menu item created successfully.');
    }

    public function show(Menu $menu)
    {
        return view('admin.menu.show', compact('menu'));
    }

    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'required|boolean',
        ]);

        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->is_available = $request->is_available;

        if ($request->hasFile('thumbnail')) {
            // Delete the old thumbnail if exists
            if ($menu->thumbnail) {
                Storage::disk('public')->delete($menu->thumbnail);
            }
            // Store the new thumbnail
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $menu->thumbnail = $path;
        }

        $menu->save();

        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu item deleted successfully.');
    }
}
