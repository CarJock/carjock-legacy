<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Ads extends Model
{
    use HasFactory;


    public static function getAllAdsAdmin() 
    {
        return DB::table('ads as a')
            ->join('ads_pages as ap', 'a.id', '=', 'ap.ads_id')
            ->join('pages as p', 'p.id', '=', 'ap.page_id')
            ->select('a.id','a.image','a.link','a.start_date', 
                'a.end_date','a.start_time', 'a.end_time', 
                'a.status', 'a.slot', 'p.title')
            ->get();
    }

    public static function getAllAdsAdminByPageId($page_id) 
    {
        return DB::table('ads as a')
            ->join('ads_pages as ap', 'a.id', '=', 'ap.ads_id')
            ->join('pages as p', 'p.id', '=', 'ap.page_id')
            ->where("p.id", $page_id)
            ->select('a.id','a.image','a.link','a.start_date', 
                'a.end_date','a.start_time', 'a.end_time', 
                'a.status', 'a.slot', 'p.title')
            ->get();
    }

    public static function getSingleAdsAdmin($id) 
    {
        return DB::table('ads as a')
            ->join('ads_pages as ap', 'a.id', '=', 'ap.ads_id')
            ->join('pages as p', 'p.id', '=', 'ap.page_id')
            ->where("a.id", $id)
            ->select('a.id','a.image','a.link','a.start_date', 
                'a.end_date','a.start_time', 'a.end_time', 
                'a.status', 'a.slot', 'ap.page_id', 'p.title', 'p.page')
            ->first();
    }

    public static function getSingleAds($page_id) 
    {
        $date = date("Y-m-d");
        $hour = (int)ltrim(date("H"), 0);

        return DB::table('ads as a')
            ->join('ads_pages as ap', 'a.id', '=', 'ap.ads_id')
            ->where([
                ['ap.page_id', $page_id],
                ['a.status', 'active'],
                ['a.start_date', '<=', $date],
                ['a.end_date', '>=', $date],
                ['a.start_time', '<=', $hour],
                ['a.end_time', '>=', $hour],
            ])
            ->select('a.image','a.link')
            ->first();
    }

    public static function getMultipleAds($page_id) 
    {
        $date = date("Y-m-d");
        $hour = (int)ltrim(date("H"), 0);
        return DB::table('ads as a')
            ->join('ads_pages as ap', 'a.id', '=', 'ap.ads_id')
            ->join('pages as p', 'p.id', '=', 'ap.page_id')
            ->where([
                ['ap.page_id', $page_id],
                ['a.status', 'active'],
                ['a.start_date', '<=', $date],
                ['a.end_date', '>=', $date],
                ['a.start_time', '<=', $hour],
                ['a.end_time', '>=', $hour],
            ])
            ->select('a.id','a.image','a.link','a.start_date', 
                'a.end_date','a.start_time', 'a.end_time', 
                'a.status', 'a.slot', 'p.title')
            ->get();
    }
}