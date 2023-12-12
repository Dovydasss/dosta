<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Page;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Models\ContactSetting;


class MenuController extends Controller
{
    /**
     * Display a listing of the menu items.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::with(['menuItems' => function ($query) {
            $query->orderBy('order');
        }])->get();
    
        return view('admin.menus.index', compact('menus'));
    }

    public function show($id)
    {
        $menu = Menu::with('menuItems')->findOrFail($id);
        return view('admin.menus.show', compact('menu'));
    }


    /**
     * Show the form for creating a new menu item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Page::all(); // Get all pages
        $contactSettings = ContactSetting::all();
        return view('admin.menus.create', compact('pages'));
    }

    /**
     * Store a newly created menu item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'location' => 'required',
            'is_visible' => 'boolean',
            'pages' => 'nullable|array',
        ]);
    
       
        $validatedData['is_visible'] = $request->has('is_visible');
    
   
        $menu = Menu::create($validatedData);
    
        // Sync the pages
        $menu->pages()->sync($request->input('pages', []));
    
        return redirect('admin/menus')->with('success', 'Menu created successfully.');
    }
    
    
    
    

    /**
     * Show the form for editing the specified menu item.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $allPages = Page::all(); // Get all pages
        return view('admin.menus.edit', compact('menu', 'allPages'));
    }
    

    /**
     * Update the specified menu item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'location' => 'required',
            'pages' => 'sometimes|array',
            'is_visible' => 'boolean',
        ]);
    
 
        $validatedData['is_visible'] = $request->has('is_visible');
    
        $menu->update($validatedData);
    
        // Sync the pages
        $menu->pages()->sync($request->input('pages', []));
    
        return redirect('admin/menus')->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified menu item from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect('admin/menus')->with('success', 'Menu item deleted successfully.');
    }
}
