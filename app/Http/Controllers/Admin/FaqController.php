<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.content-management.faqs.index',[
            'faqs' => Faq::orderby("sort", "ASC")->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faqs = Faq::all();
        $count = Faq::count();
        
        return view('admin.content-management.faqs.create', compact('faqs', 'count'));
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $faqs = new Faq;
        $faqs->question = $request->question;
        $faqs->description = $request->description;
        $faqs->sort = $request->sort;

        $faqs->save();

        return redirect()->route('admin.faqs.index')->with('message', 'Question has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $faqs = Faq::where('id',$id)->first();
        $count = Faq::count();

        return view('admin.content-management.faqs.edit', compact('faqs', 'count'));
     }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $question = $request->question;
        $description = $request->description;
        $new_sort = $request->sort;
        $faqs = Faq::find($id);
        ##call internal method for others links rearranging
        $this->rearrangeSortOrder($faqs, $new_sort, $question, $description);
        
        return redirect()->route('admin.faqs.index')->with('message', 'Question has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faqs = Faq::where('id',$id)->first();
        $this->rearrangeDeleteSortOrder($faqs->sort);
        $faqs->delete();

        return redirect()->route('admin.faqs.index')->with('message', 'Question has been Deleted successfully.');

    }

    private function rearrangeSortOrder($faqs, $new_sort, $question, $description)
    {
        $current_sort = $faqs->sort;
        if ($current_sort == $new_sort) {
            $faqs->question = $question;
            $faqs->description = $description;
            $faqs->save();
            return;
        }
        if ($current_sort < $new_sort) {
            Faq::where('sort', '>', $current_sort)
                ->where('sort', '<=', $new_sort)
                ->decrement('sort');
        } else {
            Faq::where('sort', '<', $current_sort)
                ->where('sort', '>=', $new_sort)
                ->increment('sort');
        }
        
        $faqs->question = $question;
        $faqs->description = $description;
        $faqs->sort = $new_sort;
        $faqs->save();
    }

    private function rearrangeDeleteSortOrder($sort)
    {
        Faq::where('sort', '>', $sort)
            ->decrement('sort');
    }
}
