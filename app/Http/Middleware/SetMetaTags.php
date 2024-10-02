<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class SetMetaTags
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Default meta tags
        $metaTags = [
            'title' => 'Carjock',
            'description' => 'Carjock Description',
            'keywords' => 'Carjock, keywords',
        ];
        // Get the route name
        $routeName = $request->route()->getName();
        $metaData = DB::table('meta_tags')->where('route_name', $routeName)->first();
        if ($metaData) {
            $metaTags['title'] = $metaData->title;
            $metaTags['description'] = $metaData->description;
            $metaTags['keywords'] = $metaData->keywords;
        } else {
            $metaData = DB::table('meta_tags')->where('route_name', "frontend.home")->first();
            $metaTags['title'] = $metaData->title;
            $metaTags['description'] = $metaData->description;
            $metaTags['keywords'] = $metaData->keywords;
        }
        View::share('metaTags', $metaTags);
        
        return $next($request);
    }
}
