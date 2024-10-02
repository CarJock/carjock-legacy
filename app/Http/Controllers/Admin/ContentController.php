<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function index()
    {
        return view('admin.content-management.page-contents.index',[
            'contents' => PageContent::with('pages')->where('page_id', 1)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contents = PageContent::with('pages')->where('id',$id)->first();
        $long_pages = ["aboutus", "disclaimer", "privacy_policy", "terms", "thankyou"];
        if (in_array($contents->pages->page, $long_pages)) {
            return view('admin.content-management.page-contents.edit_ckeditor',['contents'=> $contents]);
        }
        return view('admin.content-management.page-contents.edit',['contents'=> $contents]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id){
        $contents = PageContent::where('id',$id)->first();
        $contents->short_heading = $request->short_heading;
        $contents->heading = $request->heading;
        $contents->content = $request->content;
        $contents->save();

        return redirect()->route('admin.contents.index')->with('message', 'Content has been updated successfully.');
    }

}
