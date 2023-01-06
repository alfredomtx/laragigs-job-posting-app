<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    // Show all listings
    public function index() {
        return view('listing.index', [
            'listings' => Listing::latest()
                ->filter(request(['tag', 'search']))
                ->paginate(4)
        ]);
    }

    // Show single listing
    public function show(Listing $listing) {
        return view('listing.show', [
            'listing' => $listing
        ]);
    }

    public function create(){
        return view('listing.create');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'description' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();
        
        Listing::create($formFields);


        return redirect('/')->with('message', 'Listing created successfully.');
    }

    public function edit(Listing $listing){
        return view('listing.edit', ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing){
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized auction');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'description' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully.');
    }

    public function destroy(Listing $listing){
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized auction');
        }
        $listing->delete();

        if ($listing->logo){
            Storage::disk('public')->delete($listing->logo);
        }

        return redirect('/')->with('message', 'Listing deleted successfully.');
    }

    public function manage(){
        return view('listing.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
