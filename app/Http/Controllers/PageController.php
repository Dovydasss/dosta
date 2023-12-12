<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\ContactSetting;


class PageController extends Controller
{
    // Display a listing of the pages
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    // Show the form for creating a new page
    public function create()
    {
        return view('admin.pages.create');
    }


    // Store a newly created page in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:pages',
            'content' => 'required',
  
        ]);


        $validatedData['published'] = $request->has('published') ? 1 : 0;
        $validatedData['is_blog'] = $request->has('is_blog') ? 1 : 0;

        $page = Page::create($validatedData);

        return redirect('admin/pages')->with('success', 'Page created successfully.');
    }


    // Display the specified page
    public function show(Page $page)
    {
        $menusToShow = $page->menus()->with('menuItems')->get();
        return view('admin.pages.show', compact('page', 'menusToShow'));
    }

    // Show the form for editing the specified page
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    // Update the specified page in storage
    public function update(Request $request, Page $page)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:pages,slug,' . $page->id,
            'content' => 'required',
        ]);

     
        $validatedData['published'] = $request->has('published') ? 1 : 0;
        $validatedData['is_blog'] = $request->has('is_blog') ? 1 : 0;

        $page->update($validatedData);

        return redirect('admin/pages')->with('success', 'Page updated successfully.');
    }

    // Remove the specified page from storage
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect('admin/pages')->with('success', 'Page deleted successfully.');
    }

    public function showBySlug($slug)
    {
        $page = Page::where('slug', $slug)->where('published', true)->firstOrFail();
    
        if ($page->is_blog) {
            $blogPosts = $page->blogPosts;
            $menusToShow = $page->menus()->with('menuItems')->get(); // Load menus for blog page
            return view('admin.blogposts.show', compact('page', 'blogPosts', 'menusToShow'));
        } else {
            $menusToShow = $page->menus()->with('menuItems')->get();
            return view('admin.pages.show', compact('page', 'menusToShow'));
        }
    }
    
    
    
    public function handleSlug($slug)
    {
        // Check for a contact form first
        $contactSetting = ContactSetting::where('slug', $slug)->first();
        if ($contactSetting) {
            return $this->handleContactPage($slug, $contactSetting);
        }
    
        // Handle the page display
        return $this->showBySlug($slug);
    }
    
    private function handleContactPage($slug, $contactSetting)
    {
        // Find the associated Page entity
        $page = Page::where('slug', $slug)->first();
    
        // Check if the page exists and retrieve the menus
        $menusToShow = collect(); // Use an empty collection as a default
        if ($page) {
            $menusToShow = $page->menus()->with('menuItems')->get();
        }
    
        // Return the contact form view
        return view('admin.contact.form', compact('contactSetting', 'menusToShow'));
    }
    

}
