<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class WordPressPost extends Model
{
    protected $connection = 'wordpress';
    protected $table = 'wp_posts';
    protected $primaryKey = 'ID';

    protected $fillable = [
        'post_author', 'post_title', 'post_content', 'post_status', 'post_date', 'post_type', 'guid'
    ];

    public static function getFeaturedPost()
    {
        // return DB::connection('wordpress')->table('wp_posts as wp')
        //     ->join('wp_users as wu', 'wu.id', '=', 'wp.post_author')
        //     ->join('wp_postmeta as pm', 'wp.id', '=', 'pm.post_id')
        //     ->join('wp_postmeta as pm2', 'pm.meta_value', '=', 'pm2.post_id')
        //     ->join('wp_term_relationships as tr', 'wp.id', '=', 'tr.object_id')
        //     ->join('wp_term_taxonomy as tt', 'tr.term_taxonomy_id', '=', 'tt.term_taxonomy_id')
        //     ->join('wp_terms as t', 'tt.term_id', '=', 't.term_id')
        //     ->where('wp.post_status', 'publish')
        //     ->where('wp.post_type', 'post')
        //     ->where('pm.meta_key', '_thumbnail_id')
        //     ->where('pm2.meta_key', '_wp_attached_file')
        //     ->where('tt.taxonomy', 'category')
        //     ->select('wp.id','wp.post_title','wp.post_content','wp.post_date', 'wp.guid', 'wp.post_name', 
        //         'wu.display_name', 'pm.meta_value AS thumbnail_id', 'pm2.meta_value AS thumbnail_url', 't.name AS category_name'
        //         )
        //     ->orderBy('wp.post_date', 'desc')
        //     ->limit(4)
        //     ->get();
    }

}
