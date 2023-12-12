<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSettingsController extends Controller
{
    /**
     * Display a listing of the page settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = PageSetting::first();
        return view('admin.page_settings.index', compact('settings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PageSetting  $pageSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(PageSetting $pageSetting)
    {
        return view('admin.page_settings.edit', compact('pageSetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PageSetting  $pageSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PageSetting $pageSetting)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'icon' => 'nullable|image|max:1024',
        ]);

        $pageSetting->title = $validatedData['title'];
        $pageSetting->description = $validatedData['description'];

        if ($request->hasFile('icon')) {
            if ($pageSetting->icon) {
                Storage::delete($pageSetting->icon);
            }

            // Store the new icon and update the icon path
            $path = $request->file('icon')->store('public/icons');
            $pageSetting->icon = $path;
        }

        $pageSetting->save();

        return redirect()->route('admin.page-settings.index')
                         ->with('success', 'Page settings updated successfully!');
    }

    /**
     * Show the form for creating new page settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page_settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'icon' => 'nullable|image|max:1024', // 1MB Max
        ]);

        $settings = new PageSetting;
        $settings->title = $validatedData['title'];
        $settings->description = $validatedData['description'];

        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('public/icons');
            $settings->icon = $path;
        }

        $settings->save();

        return redirect()->route('admin.page-settings.index')
                         ->with('success', 'New page settings created successfully!');
    }

    public function destroy(PageSetting $pageSetting)
{
    // Delete the icon file from storage if it exists
    if ($pageSetting->icon) {
        Storage::delete($pageSetting->icon);
    }

    // Delete the page settings from the database
    $pageSetting->delete();

    return redirect()->route('admin.page-settings.index')
                     ->with('success', 'Page settings deleted successfully.');
}
}
