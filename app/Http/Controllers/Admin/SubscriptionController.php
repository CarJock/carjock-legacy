<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.subscriptions.index',[
            'subscriptions'=> Subscription::paginate(20)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteAll()
    {
        Subscription::truncate();
        return true;
    }

    public function exportCSV(Request $request)
    {
        $subs = Subscription::pluck("email")->toArray();
        $emails = implode(', ', $subs);
        $filename = 'subscription.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, [$emails]);
        fclose($handle);
        return \Response::make('', 200, $headers);
    }
}
