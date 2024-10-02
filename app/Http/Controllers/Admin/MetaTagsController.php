<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetaTags;
use Illuminate\Http\Request;
use Faker\Provider\Image;

class MetaTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.meta-tags.index',[
            'metatags' => MetaTags::get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $metatags = MetaTags::where('id',$id)->first();
        if (!$metatags) {
            return redirect()->route('admin.metaTags.index')->with('message', 'meta tags not found.');   
        }
        return view('admin.meta-tags.edit',['metatags'=> $metatags]);
            
     }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id){
        $metatags = MetaTags::where('id',$id)->first();
        $metatags->title = $request->title;
        $metatags->description = $request->description;
        $metatags->keywords = $request->keywords;
        
        $metatags->save();
        
        return redirect()->route('admin.metaTags.index')->with('message', 'meta tags has been updated successfully.');
    }

}
