<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.content-management.contact-us.index',[
            'contacts' => Contact::paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,$id)
    {
        $contact = Contact::where('id',$id)->first();

        return view('admin.content-management.contact-us.show',[
            'contact'=> $contact,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        $contacts = Contact::where('id',$id)->first();

        return view('admin.content-management.ContactUs.edit',['contacts'=> $contacts]);

     }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id){
        $contacts = Contact::where('id',$id)->first();

        $contacts->message = $request->message;
        $contacts->phone = $request->phone;
        $contacts->first_name = $request->first_name;
        $contacts->last_name = $request->last_name;
        $contacts->email = $request->email;



        $contacts->save();


        return redirect()->route('admin.contact.index')->with('message', 'Contact Section has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function exportCSV(Request $request)
    {
        $contacts = Contact::all();
        $filename = 'contactus.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'public',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];
        $callback = function() use ($contacts)
        {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['First Name', 'Last Name', 'Email', 'Phone', 'Question', 'Message',  'Creaeted At']); 
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                                $contact->first_name,
                                $contact->last_name,
                                $contact->email,
                                $contact->phone,
                                $contact->question,
                                $contact->message,
                                $contact->created_at,
                            ]);
            }
            fclose($handle);
        };

        return \Response::stream($callback, 200, $headers);
    }
}
