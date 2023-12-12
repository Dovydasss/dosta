<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;


class MenuItemController extends Controller
{
    // Lists items for a specific menu
    public function index($menuId)
    {
        $menu = Menu::findOrFail($menuId);
        $menuItems = $menu->menuItems()->orderBy('order')->get();
        
        return view('admin.menuitems.index', compact('menu', 'menuItems'));
    }

    // Shows a form to create a new menu item within a specific menu
    public function create($menuId)
    {
        $menu = Menu::findOrFail($menuId);
        return view('admin.menuitems.create', compact('menu'));
    }

    // Stores a new menu item within a specific menu
    public function store(Request $request, $menuId)
    {
        $menu = Menu::findOrFail($menuId);
    
        $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|url',
            // Remove the 'order' validation, as it will be assigned dynamically
        ]);
    
        // Find the maximum order value for menu items in this menu
        $maxOrder = $menu->menuItems()->max('order');
    
        // Increment the maximum order value by 1 for the new menu item
        $order = $maxOrder + 1;
    
        // Create the new menu item with the calculated order
        $menu->menuItems()->create([
            'title' => $request->input('title'),
            'url' => $request->input('url'),
            'order' => $order, // Set the order to the calculated value
        ]);
    
        return redirect('admin/menus')
            ->with('success', 'Menu item created successfully.');
    }

  
    public function show($menuId, MenuItem $menuItem)
    {
        $menu = Menu::findOrFail($menuId);
        return view('menuitems.show', compact('menu', 'menuItem'));
    }

    // Shows a form to edit an existing menu item within a specific menu


    public function edit($menuId, $menuItemId)
    {
        $menuItem = MenuItem::where('id', $menuItemId)->where('menu_id', $menuId)->firstOrFail();
        return view('admin.menuitems.edit', compact('menuItem'));
    }



    // Updates an existing menu item within a specific menu

    public function update(Request $request, $menuId, $menuItemId)
    {
        $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|url',
            'order' => 'required|integer',
        ]);

        $menuItem = MenuItem::where('id', $menuItemId)->where('menu_id', $menuId)->firstOrFail();
        $menuItem->update($request->all());

        return redirect('admin/menus')
            ->with('success', 'Menu item updated successfully.');
    }


    // Deletes a menu item within a specific menu
    public function destroy($menuId, $menuitemId)
    {
        $menuItem = MenuItem::find($menuitemId);
        if ($menuItem) {
            $menuItem->delete();
            return redirect('admin/menus')
                ->with('success', 'Menu item deleted successfully');
        }
    }

    public function reorder(Request $request, $menuId)
    {
        $itemId = $request->input('itemId');
        $direction = $request->input('direction');
    
        try {
            DB::transaction(function () use ($itemId, $direction, $menuId) {
                $menuItem = MenuItem::where('id', $itemId)->where('menu_id', $menuId)->firstOrFail();
                $currentOrder = $menuItem->order;
    
                if ($direction === 'up') {
                    // Move item up
                    $previousItem = MenuItem::where('menu_id', $menuId)->where('order', '<', $currentOrder)->orderBy('order', 'desc')->first();
                    if ($previousItem) {
                        $menuItem->order = $previousItem->order;
                        $previousItem->order = $currentOrder;
                        $menuItem->save();
                        $previousItem->save();
                    }
                } elseif ($direction === 'down') {
                    // Move item down
                    $nextItem = MenuItem::where('menu_id', $menuId)->where('order', '>', $currentOrder)->orderBy('order', 'asc')->first();
                    if ($nextItem) {
                        $menuItem->order = $nextItem->order;
                        $nextItem->order = $currentOrder;
                        $menuItem->save();
                        $nextItem->save();
                    }
                }
            });
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }


}
