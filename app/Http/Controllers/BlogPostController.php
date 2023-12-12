<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogPostController extends Controller
{
    // Display a listing of the blog posts
    public function index()
    {
        $blogPosts = BlogPost::all();
        
        return view('admin.blogposts.index', compact('blogPosts'));



    }

   
    public function create()
    {
        $pages = Page::all(); 
        return view('admin.blogposts.create', compact('pages'));
    }

   
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'page_id' => 'required|exists:pages,id', 
        ]);

        BlogPost::create($validatedData);

        return redirect('admin/blogposts')->with('success', 'Blog post created successfully.');
    }

    public function show($id)
    {
        $blogPost = BlogPost::findOrFail($id);
        $page = Page::findOrFail($blogPost->page_id);
    
       
        $menusToShow = $page->menus()->with('menuItems')->get();
    
        return view('admin.blogposts.blogpost-detail', compact('blogPost', 'menusToShow'));
    }
    
    

    

        
    public function edit($id)
    {
        $blogPost = BlogPost::findOrFail($id);
        $pages = Page::all();
    
        return view('admin.blogposts.edit', compact('blogPost', 'pages'));
    }
    
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'page_id' => 'required|exists:pages,id',
        ]);
    
      
        $blogPost = BlogPost::findOrFail($id);
    
     
        $blogPost->update($validatedData);
    
        return redirect('admin/blogposts')->with('success', 'Blog post updated successfully.');
    }
    
    

   
    public function destroy($id)
    {
        $blogPost = BlogPost::findOrFail($id);

        $blogPost->delete();

        return redirect('admin/blogposts')->with('success', 'Blog post deleted successfully.');
    }
}
