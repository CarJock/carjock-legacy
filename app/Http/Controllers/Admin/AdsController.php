<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\AdsPages;
use App\Models\Page;
use Illuminate\Http\Request;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Storage;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ads::getAllAdsAdmin();
        return view('admin.ads.index',["ads" => $ads]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ads = Ads::all();
        $pages = Page::whereIn("id", [1, 8, 17])->get();
        
        return view('admin.ads.create', compact('ads', 'pages'));
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $start_date = str_replace('/', '-', $request->start_date);
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = str_replace('/', '-', $request->end_date);
        $end_date = date('Y-m-d', strtotime($end_date));
        $page_id = $request->page_id;
        $start_time = $request->start_time;
        $pages = Page::where("id", $page_id)->first();
        $page_title = !empty($pages) ? $pages->page : "";
        ###validate if the slot is already booked
        $validate_data = Ads::getAllAdsAdminByPageId($page_id);
        if ($validate_data) {
            foreach($validate_data as $validate) {
                if ($start_date >= $validate->start_date && $start_time >= $validate->start_time) {
                    return back()->withInput($request->input())
                        ->with('message', 'Slot already booked.');
                }
            }
        }


        die("hello janu");
        ##logic for save into Ads table
        $ads = new Ads;
        $ads->link = $request->link;
        $ads->start_date = $start_date;
        $ads->end_date = $end_date;
        $ads->start_time = $start_time;
        $ads->end_time = $request->end_time;
        $ads->status = $request->status;
        $fine_name = "";

        if ($request->hasFile('image') && request('image') != "") {
            $image = $request->file('image');
            $slot = ($ads->slot == "") ? 0 : $ads->slot;
            $fine_name = $page_title  . $slot . '.' . $start_time . '.' . $image->getClientOriginalExtension();
            $file_path = public_path('storage/ads/'.$fine_name);
            if(\File::exists($file_path) && $ads->image != "") {
                unlink($file_path); //delete from storage
            }
            $path = "ads/".$fine_name;
            Storage::disk('public')->put($path, file_get_contents($image));
        }
        $ads->image = ($fine_name != "") ? $fine_name : "";
        $ads->slot = ($ads->slot == "") ? "" : $ads->slot;
        $ads->save();
        $ads_id = $ads->id;
        ##save into ads_page
        $ads_pages = new AdsPages;
        $ads_pages->page_id = $page_id;
        $ads_pages->ads_id = $ads_id;
        $ads_pages->save();

        return redirect()->route('admin.ads.index')->with('message', 'Ads has been created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ads = Ads::getSingleAdsAdmin($id);
        
        return view('admin.ads.edit', ['ads' => $ads]);
     }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $start_date = str_replace('/', '-', $request->start_date);
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = str_replace('/', '-', $request->end_date);
        $end_date = date('Y-m-d', strtotime($end_date));
        $start_time = $request->start_time;
        $page_title = $request->page;
        ##get update Ads
        $ads = Ads::where('id',$id)->first();
        $ads->start_date = $start_date;
        $ads->end_date = $end_date;
        $ads->start_time = $start_time;
        $ads->end_time = $request->end_time;
        $ads->status = $request->status;
        $fine_name = "";

        if ($request->hasFile('image') && request('image') != "") {
            $image = $request->file('image');
            $slot = ($ads->slot == "") ? 0 : $ads->slot;
            $fine_name = $page_title  . $slot . '.' . $start_time . '.' . $image->getClientOriginalExtension();
            
            $file_path = public_path('storage/ads/'.$ads->image);
            if(\File::exists($file_path) && $ads->image != "") {
                unlink($file_path); //delete from storage
            }
            $path = "ads/".$fine_name;
            Storage::disk('public')->put($path, file_get_contents($image));
        }
        $ads->image = ($fine_name != "") ? $fine_name : $ads->image;
        
        $ads->save();
        return redirect()->route('admin.ads.index')->with('message', 'Ads has been updated successfully.');
    }

}
