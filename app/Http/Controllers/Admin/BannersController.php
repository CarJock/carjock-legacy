<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Page;
use Illuminate\Http\Request;
use Faker\Provider\Image;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.content-management.banners.index',[
            'banners' => Banner::with('pages')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $banners = Banner::with('pages')->where('id',$id)->first();
        if (!$banners) {
            return redirect()->route('admin.banners.index')->with('message', 'Banners not found.');   
        }
        return view('admin.content-management.banners.edit',['banners'=> $banners]);
            
     }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id){
        $banners = Banner::with('pages')->where('id',$id)->first();
        $banners->heading = $request->heading;
        $banners->content = $request->content;
        $fine_name = "";

        if ($request->hasFile('image') && request('image') != "") {
            $file_path = public_path('storage/banners/'.$banners->image);
            if(\File::exists($file_path) && $banners->image != "") {
                unlink($file_path); //delete from storage
            }
            $image = $request->file('image');
            $fine_name = $banners->pages->page . '.' . $image->getClientOriginalExtension();
            $path = "banners/".$fine_name;
            \Storage::disk('public')->put($path, file_get_contents($image));
        }
        $banners->image = ($fine_name != "") ? $fine_name : $banners->image;
        $banners->save();
        return redirect()->route('admin.banners.index')->with('message', 'Banners has been updated successfully.');
    }

}
