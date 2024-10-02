<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use App\Models\Faq;
use App\Models\Ads;
use App\Models\Banner;
use App\Models\AdsLogs;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Forum
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function page($slug)
    {
        $pages = ['thankyou'];

        if(!in_array($slug, $pages)) abort(404);
        return view('frontend.pages.'.$slug);
    }

    public function aboutUs()
    {
        $aboutus = PageContent::where("page_id", 5)->first();
        $banner = Banner::where("page_id", 5)->first();
        return view('frontend.pages.about-us', compact('aboutus','banner'));
    }

    public function disclaimer()
    {
        $disclaimer = PageContent::where("page_id", 7)->first();
        $banner = Banner::where("page_id", 7)->first();
        return view('frontend.pages.disclaimer', compact('disclaimer','banner'));
    }

    public function termsConditions()
    {
        $terms = PageContent::where("page_id", 11)->first();
        $banner = Banner::where("page_id", 11)->first();
        return view('frontend.pages.term-and-conditions', compact('terms','banner'));
    }

    public function privacy()
    {
        $privacy = PageContent::where("page_id", 10)->first();
        $banner = Banner::where("page_id", 10)->first();
        return view('frontend.pages.privacy-policy', compact('privacy','banner'));
    }

    public function faqs()
    {
        $faqs_content = PageContent::where("page_id", 8)->first();
        $faqs = Faq::orderby("sort", "ASC")->get();
        $ads = Ads::getSingleAds(8);
        $banner = Banner::where("page_id", 8)->first();
        ##insert into view ads 
        if (!empty($ads)) {
            $ads_logs = new AdsLogs;
            $ads_logs->page_id = 8;
            $ads_logs->type = "view";
            $ads_logs->save();
        }

        return view('frontend.pages.faqs', compact('faqs_content','faqs', 'ads', 'banner'));
    }

    public function thankyou()
    {
        $thankyou = PageContent::where("page_id", 19)->first();
        return view('frontend.pages.thankyou', ["thankyou" => $thankyou]);
    }

    public function adsClicks(Request $request)
    {
        $ads_logs = new AdsLogs;
        $ads_logs->page_id = $request->page_id;
        $ads_logs->slot = ($request->slot == "0") ? "" : $request->slot;
        $ads_logs->type = "click";

        $ads_logs->save();
        
        return true;
    }
}
