<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Header;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;



class HeaderController extends Controller
{

    public function index()
    {
        $header = Header::firstOrNew([], [
            'show_header' => false, 
            'header_first' => false, 
 
        ]);

        return view('admin.header.index', compact('header'));
    }


    public function edit()
    {


        return view('header.edit', compact('header'));
    }

    // Update the header
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'header_image' => 'nullable|image|max:2048',
            'header_width' => 'required|integer|min:100',
            'header_height' => 'required|integer|min:100',
        ]);
    
        $validatedData['show_header'] = $request->has('show_header');
        $validatedData['header_first'] = $request->has('header_first');
    
        $header = Header::first();
    
        if ($request->hasFile('header_image')) {
            if ($header && $header->header_image) {
                // Delete the old image
                File::delete(public_path($header->header_image));
            }
        
            $image = $request->file('header_image');
            $filename = Str::random(40) . '.' . $image->getClientOriginalExtension();
        
            // Resize image using Intervention Image
            $img = Image::make($image->getRealPath());
            $width = $validatedData['header_width'];
$height = $validatedData['header_height'];
            $img->resize($width, $height);
        
            // Save the image to the public/header directory
            $destinationPath = public_path('header');
            $img->save($destinationPath . '/' . $filename);
        
            // Update the path to the new image
            $validatedData['header_image'] = 'header/' . $filename;
        }
        
        // If there is no header, create a new one, otherwise update the existing one
        if (!$header) {
            Header::create($validatedData);
        } else {
            $header->update($validatedData);
        }
    
        return redirect()->back()->with('success', 'Header updated successfully.');
    }

}
