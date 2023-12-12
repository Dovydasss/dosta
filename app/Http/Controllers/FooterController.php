<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Footer;

class FooterController extends Controller
{

    public function index()
    {
        $footer = Footer::firstOrNew([], [
            'show_footer' => false,
            'footer_text' => '',

        ]);
    
        return view('admin.footer.index', compact('footer'));
    }
    
    public function edit()
    {
    
        $footer = Footer::firstOrNew([], [
            'show_footer' => false,
            'footer_text' => '',
        ]);

        return view('admin.footer.edit', compact('footer'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'show_footer' => 'sometimes|boolean',
            'footer_text' => 'nullable|string',
        ]);

   
        $validatedData['show_footer'] = $request->boolean('show_footer');

 
        $footer = Footer::first();
        if ($footer) {
            $footer->update($validatedData);
        } else {
            Footer::create($validatedData);
        }

        return redirect()->back()->with('success', 'Footer updated successfully.');
    }
}
