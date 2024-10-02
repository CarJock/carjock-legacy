<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\PageContent;
use App\Models\Banner;
use App\Models\Subscription;
use App\Models\Contact;

class ContactUsController extends Controller
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
     * Compare the cars details.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $contactus = PageContent::where("page_id", 6)->first();
        $banner = Banner::where("page_id", 6)->first();
        return view('frontend.contact-us', compact('contactus','banner'));
    }


    /**
     * Store contact details and send email
     * 
     * @return \Illuminate\Contracts\Support\Json
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'question' => 'required',
            'message' => 'required',
        ]);

        $contact = new Contact;
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->question = $request->question;
        $contact->message = $request->message;
        $contact->save();

        return back()->with('success', 'Your message has been sent successfully!');
        
    }

    public function storeSubscriptions(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);
        
        Subscription::create([
            'email' => $request->email,
        ]);

        return response()->json(['success' => 'Thank you for subscribing!']);
    }


}
