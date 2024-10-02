<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdsLogs;
use Illuminate\Http\Request;

class AdsLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('admin.ads_logs.index', [
            'ads_logs' => AdsLogs::join('pages', 'pages.id', '=', 'ads_logs.page_id')
                ->when($request->type, function ($query) use ($request) {
                    return $query->where('type', $request->type);
                })->orderby("ads_logs.id", "desc")->paginate(20),
        ]);
    }
}
