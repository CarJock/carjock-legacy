<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMediaLinks;
use Illuminate\Http\Request;

class SocialMediaLinksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $social = SocialMediaLinks::orderby("sort", "ASC")->get();
        return view('admin.content-management.social-media-links.index',['social'=> $social]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $social = SocialMediaLinks::where("id", $id)->first();
        $count = SocialMediaLinks::count();
        
        return view('admin.content-management.social-media-links.edit', compact('social', 'count'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $social_name = $request->social_name;
        $social_link = $request->social_link;
        $new_sort = $request->sort;
        $social = SocialMediaLinks::find($id);
        ##call internal method for others links rearranging
        $this->rearrangeSortOrder($social, $new_sort, $social_link, $social_name);
        
        return redirect()->route('admin.media.index')->with('message', 'Social Links has been updated successfully.');
    }

    private function rearrangeSortOrder($social, $new_sort, $social_link, $social_name)
    {
        $current_sort = $social->sort;
        if ($current_sort == $new_sort) {
            $social->social_name = $social_name;
            $social->social_link = $social_link;
            $social->save();
            return;
        }
        if ($current_sort < $new_sort) {
            SocialMediaLinks::where('sort', '>', $current_sort)
                ->where('sort', '<=', $new_sort)
                ->decrement('sort');
        } else {
            SocialMediaLinks::where('sort', '<', $current_sort)
                ->where('sort', '>=', $new_sort)
                ->increment('sort');
        }
        
        $social->social_name = $social_name;
        $social->social_link = $social_link;
        $social->sort = $new_sort;
        $social->save();
    }
}
