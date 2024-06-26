<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('user.menu.index', compact('menus'));
    }

    public function show($menu)
    {
        $menu = Menu::findOrFail($menu);
        return view('user.menu.show', compact('menu'));
    }
}
