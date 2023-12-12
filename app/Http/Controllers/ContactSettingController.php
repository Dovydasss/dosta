<?php

namespace App\Http\Controllers;

use App\Models\ContactSetting;
use App\Models\Message;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Str;

class ContactSettingController extends Controller
{
    // List all contact settings
    public function index()
    {
        $contactSettings = ContactSetting::all();
        return view('admin.contact.index', compact('contactSettings'));
    }

    // Show form to create a new contact setting
    public function create()
    {
        return view('admin.contact.create');
    }

    // Store a new contact setting and create an associated page
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'recipient_email' => 'required|email',
            'recipient_name' => 'required',
            'slug' => 'required|unique:contact_settings|unique:pages,slug',
        ]);

        DB::beginTransaction();
        try {
            $contactSetting = ContactSetting::create($validatedData);

            // Create a corresponding Page for the Contact Setting
            $page = Page::create([
                'title' => 'Contact - ' . $contactSetting->recipient_name,
                'slug' => $validatedData['slug'],
                'content' => 'This is the contact page for ' . $contactSetting->recipient_name,
                'published' => true,
            ]);

            // Here, link the page to menus if necessary. You might use a request input to get menu IDs.
            $menuIds = $request->input('menus', []); // This should come from your form
            $page->menus()->sync($menuIds);

            DB::commit();
            return redirect('admin/contacts')->with('success', 'Contact setting and corresponding page created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('An error occurred: ' . $e->getMessage());
        }
    }

    // Show a specific contact setting
    public function show($id)
    {
        $contactSetting = ContactSetting::findOrFail($id);
        return view('admin.contact.show', compact('contactSetting'));
    }

    // Show form to edit a contact setting
    public function edit($id)
    {
        $contactSetting = ContactSetting::findOrFail($id);
        return view('admin.contact.edit', compact('contactSetting'));
    }

    // Update a specific contact setting and its associated page
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'recipient_email' => 'required|email',
            'recipient_name' => 'required',
            'slug' => 'required|unique:contact_settings,slug,' . $id . '|unique:pages,slug',
        ]);

        DB::beginTransaction();
        try {
            $contactSetting = ContactSetting::findOrFail($id);
            $contactSetting->update($validatedData);

            // Find or create the Page associated with this Contact Setting
            $page = Page::firstOrNew(['slug' => $contactSetting->slug]);
            $page->title = 'Contact - ' . $contactSetting->recipient_name;
            $page->content = 'Updated content for contact page'; // You might update this from a form input
            $page->published = true;
            $page->save();

            // Here, update the page's linked menus if necessary
            $menuIds = $request->input('menus', []); // This should come from your form
            $page->menus()->sync($menuIds);

            DB::commit();
            return redirect('admin/contacts')->with('success', 'Contact setting and corresponding page updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('An error occurred: ' . $e->getMessage());
        }
    }

    // Delete a specific contact setting and its associated page
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $contactSetting = ContactSetting::findOrFail($id);
            $page = Page::where('slug', $contactSetting->slug)->first();

            if ($page) {
                $page->delete(); // Delete the associated page
            }

            $contactSetting->delete(); // Then delete the contact setting
            DB::commit();
            return redirect('admin/contacts')->with('success', 'Contact setting and corresponding page deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('An error occurred: ' . $e->getMessage());
        }
    }

    // Show the contact form to users
    public function showContactForm($slug) {
        $contactSetting = ContactSetting::where('slug', $slug)->firstOrFail();

        // Retrieve the Page entity that corresponds to the ContactSetting.
        $page = Page::where('slug', $slug)->first();

        // Retrieve menus linked to this page through the pivot table.
        $menusToShow = collect();
        if ($page) {
            $menusToShow = $page->menus()->with('menuItems')->get();
        }

        // Now, return the view with both 'contactSetting' and 'menusToShow'.
        return view('contact.form', compact('contactSetting', 'menusToShow'));
    }

    public function submitContactForm(Request $request, $slug)
    {
        $contactSetting = ContactSetting::where('slug', $slug)->firstOrFail();
    
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
    
        $message = new Message();
        $message->name = $validatedData['name'];
        $message->email = $validatedData['email'];
        $message->title = $validatedData['subject'];
        $message->message = $validatedData['message'];
        $message->save();
    
        // Send the email
        Mail::to($contactSetting->recipient_email)->send(new ContactFormMail($validatedData));
    
       
        return back()->with('success', 'Your message has been sent successfully!');
    }
}