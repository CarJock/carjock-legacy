<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Ads;
use App\Models\Model;
use App\Models\Style;
use App\Models\Banner;
use App\Models\AdsLogs;
use App\Models\Vehicle;
use App\Models\Division;
use App\Models\FuelType;
use App\Models\EngineType;
use App\Models\PageContent;
use App\Models\VehicleImage;
use Illuminate\Http\Request;
use App\Models\WordPressPost;
use App\Utils\PaginateCollection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if ($user && $user->status == "blocked") {
            \Auth::logout();
            return redirect()->route('frontend.login')->with('message', 'You are blocked by admin.');
        }
        #$featured = collect();
        #$featured_main = Vehicle::where('feature', 'yes')->where('garage', '!=', 1)->inRandomOrder()->limit(4)->get();
        #$featured_main_one = Vehicle::whereNotIn('id', $featured->push($featured_main->pluck('id'))->first()->toArray())->where('garage', '!=', 1)->inRandomOrder()->where('feature', 'yes')->limit(4)->get();

        $featured = Cache::remember('featured_vehicles', 60, function () {
            return Vehicle::where('feature', 'yes')->where('garage', '!=', 1)->take(100)->get();
        });
        
        // Get random unique values for the first array
        if (count($featured) > 4) {
            $randomValuesArray1 = $featured->random(4);
        } elseif (count($featured) < 4 && count($featured) > 0) {
            $randomValuesArray1 = $featured->random();
        } else {
            $randomValuesArray1 = collect();
        }
        // Remove the selected values from the original collection
        $remainingCollection = $featured->diff($randomValuesArray1);
        // Get random unique values for the second array from the remaining values
        if (count($remainingCollection) > 4) {
            $randomValuesArray2 = $remainingCollection->random(4);
        } elseif (count($remainingCollection) < 4 && count($remainingCollection) > 0) {
            $randomValuesArray2 = $remainingCollection->random();
        } else {
            $randomValuesArray2 = collect();
        }
        // Convert the results to arrays
        $featured_main = $randomValuesArray1->all();
        $featured_main_one = $randomValuesArray2->all();
        $drivetrain = ['Front Wheel Drive', 'All Wheel Drive', 'Rear Wheel Drive', 'Four Wheel Drive'];
        $ads = Ads::getMultipleAds(1);
        ##insert into view ads 
        if ($ads->isEmpty() == "false") {
            AdsLogs::insert([
                [
                    'page_id' => 1,
                    'type' => "view",
                    'slot' => 1,
                ],
                [
                    'page_id' => 1,
                    'type' => "view",
                    'slot' => 2,
                ],
            ]);
        }
        $wp_posts = [];//WordPressPost::getFeaturedPost();
        foreach ($wp_posts as &$post) {
            $post->post_content = $this->clean_wp_content($post->post_content);
        }
        
        return view('frontend.home', [
            'years' => [date('Y') - 1, date('Y')],
            'makes' => isset(request()->year) ? Division::where('year', request()->year)->get() : '',
            'models' => isset(request()->make) ? Model::whereHas(function ($query) {
                $query->where('name', request()->make);
            })->get() : '',
            'engines' => EngineType::select('name', 'id')->groupBy('number')->get(),
            'engine_types' => array_flip($this->types('engine_types')),
            'fuels' => FuelType::select('name', 'id')->groupBy('number')->get(),
            'economy' => FuelType::select('name', 'id', 'economy')->groupBy('economy')->get(),
            'capacity' => FuelType::select('name', 'id', 'capacity')->groupBy('capacity')->get(),
            'body_types' => array_flip($this->types('body_types')),
            'fuel_types' => array_flip($this->types('fuel_types')),
            'drivetrain' => $drivetrain,
            'featured_vehicles' => $featured_main,
            'featured_vehicle_one' => $featured_main_one,
            'content' => PageContent::where("page_id", 1)->get(),
            'banner' => Banner::where("page_id", 1)->first(),
            'ads' => $ads,
            'posts' => $wp_posts
            // 'featured_vehicle_second' => $featured_main_second,
            // 'featured_vehicle_carosal' => $featured_carosal
        ]);
    }

    public function show($id)
    {
        $vehicle = Vehicle::with('fuel_type', 'engine_type')->findOrFail($id);
        $detail = json_decode($vehicle->data);

        $get_style_model = Style::where('number', $vehicle->style_id)->first();
        if (isset($get_style_model->model_id)) {
            $get_all_styles = Style::where('model_id', $get_style_model->model_id)->pluck('number')->toArray();
            $related_vehicles = Vehicle::whereIn('style_id', $get_all_styles)->whereNotIn('id', [$id])->get();
        }
        $images = VehicleImage::where('style_id', $vehicle->style_id)->get();

        //dd($images->count());
        return view('frontend.vehicle-detail', [
            'id' => $id,
            'vehicle' => $vehicle,
            'detail' => $detail,
            'related' => $related_vehicles ?? null,
            'images' => $images
        ]);
    }

    /**
     * Ajax Query
     *
     * @return \Illuminate\Contracts\Support\Json
     */
    public function query()
    {
        if (request()->has('type') && request()->has('value')) {
            $type = request()->type;
            $value = request()->value;
            if ($type == 'year') {
                return [
                    'type' => 'division',
                    'data' => Division::select('name')->where('year', $value)->groupBy('name')->get()
                ];
                exit;
            } else if ($type == 'make') {
                $division_number = Division::select('number')->where('name', $value)->first();
                return [
                    'type' => 'model',
                    'data' => Model::select('name')->where('division_id', $division_number->number)->groupBy('name')->get()
                ];
                exit;
            }
        }
    }

    private function types($type)
    {
        $data = [
            'body_types' => [
                'Sedan' => '4dr Car',
                'SUV' => 'Sport Utility',
                'Coup' => '2dr Car',
                'Pickup' => 'Crew Cab Chassis-Cab|Short Bed|Standard Bed|Long Bed|Crew Cab Pickup|Extended Cab Chassis-Cab|Regular Cab Chassis-Cab',
                'Mini-van' => 'Mini-van',
                'Hatchback' => 'Hatchback|3dr Car',
                'Convertible' => 'Convertible',
                'Van' => 'Full-size Cargo Van|Full-size Passenger Van',
                'Station Wagon' => 'Station Wagon',
                'Specialty Vehicle' => 'Specialty Vehicle'
            ], 'engine_types' => [
                'Electric' => 'Electric Motor',
                '3 Cylinder' => '3 Cylinder Engine',
                '4 Cylinder' => '4 Cylinder Engine',
                '6 Cylinder' => 'V6 Cylinder Engine|Straight 6 Cylinder Engine|Flat 6 Cylinder Engine',
                '8 Cylinder' => '8 Cylinder Engine',
                '10 Cylinder' => '10 Cylinder Engine',
                '12 Cylinder' => '12 Cylinder Engine',
            ], 'fuel_types' => [
                'Gas' => 'Gasoline Fuel|Flex Fuel Capability',
                'Electric' => 'Electric Fuel System',
                'Plugin Hybrid' => 'Plug-In Electric/Gas',
                'Hybrid' => 'Gasoline/Mild Electric Hybrid|Gas/Electric Hybrid',
                'Diesel' => 'Diesel Fuel',
                'Hydrogen' => 'Hydrogen Fuel',
            ]
        ];

        return $data[$type];
    }

    /**
     * Search vehicle
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search()
    {
        $drivetrain = ['Front Wheel Drive', 'All Wheel Drive', 'Rear Wheel Drive', 'Four Wheel Drive'];
        $year = request()->year;
        $make = request()->make;
        $model = request()->model;
        $fuel_type = request()->fuel_type;
        $engine_type = request()->engine_type;
        $fuel_economy = request()->fuel_economy;
        $fuel_capacity = request()->fuel_capacity;
        $search = collect(request()->search)->filter()->all();
        $find = collect(request()->find)->filter()->all();

        $range_searches = request()->range;
        $custom_search = request()->custom_search;
        $up_range = collect(request()->up)->filter()->all();
        $down_range = collect(request()->down)->map(function ($down, $key) {
            if ($key === 'length_overall' && (int)$down === 250) return null;
            if ($key === 'height_overall' && (int)$down === 100) return null;
            if ($key === 'width_overall' && (int)$down === 100) return null;

            return $down;
        })->filter()->all();

        $sort = 'pricing';
        $sort_type = 'asc';
        if (isset(request()->order_by) && request()->order_by === 'pricing_asc') {
            $sort = 'pricing';
            $sort_type = 'asc';
        } elseif (isset(request()->order_by) && request()->order_by === 'pricing_desc') {
            $sort = 'pricing';
            $sort_type = 'desc';
        } elseif (isset(request()->order_by) && request()->order_by === 'name_asc') {
            $sort = 'division';
            $sort_type = 'asc';
        } elseif (isset(request()->order_by) && request()->order_by === 'name_desc') {
            $sort = 'division';
            $sort_type = 'desc';
        }

        $vehicles = Vehicle::where('garage', 0)
            ->where('pricing', '!=', 0);

        if ($year) {
            $vehicles->where('name', 'like', '%' . $year . '%');
        } else {
            $vehicles->where(function ($query) {
                $query->where('name', 'like', '%2023%')
                      ->orWhere('name', 'like', '%2024%');
            });
        }

        if ($make) {
            $vehicles->where('division', $make);
        }

        if ($model) {
            $vehicles->where('name', 'like', '%' . $model . '%');
        }

        if (is_array($up_range) && count($up_range) > 0) {
            foreach ($up_range as $key => $value) {
                if ($key == 'cargo_volume') {
                    $key = 'cargo_volume_to_seat_1';
                }
                $vehicles->where($key, '>', (int)$value);
            }
        }

        if (is_array($down_range) && count($down_range) > 0) {
            foreach ($down_range as $key => $value) {
                $vehicles->where($key, '<', (int)$value);
            }
        }

        if (is_array($find) && count($find) > 0) {
            foreach ($find as $key => $value) {
                if ($key === 'sun_moon_roof') {
                    $vehicles->where('data', 'like', '%/Moonroof%');
                } else {
                    $vehicles->where('data', 'like', '%' . $value . '%');
                }
            }
        }

        if (is_array($search) && count($search) > 0) {
            foreach ($search as $key => $value) {
                if ($key === 'body_type') {
                    $vehicles->whereIn('body_type', explode('|', $value));
                }

                if ($key === 'fuel_type') {
                    $vehicles->whereHas('fuel_type', function ($query) use ($value) {
                        $query->whereIn('name', explode('|', $value));
                    })
                        ->where('fuel_type_id', '!=', 0)
                        ->whereNotNull('fuel_type_id');
                }

                if ($key === 'drive_train') {
                    $vehicles->where('data', 'like', '%' . $value . '%');
                }

                if ($key === 'max_passenger') {
                    $vehicles->where('seating', $value);
                }

                if ($key === 'price' && $value !== '$') {
                    $vehicles->where('pricing', '<=', (int)str_replace('$', '', $value));
                }
            }
        }

        $vehicles = $vehicles->orderBy('created_at', 'desc')
            ->orderBy($sort, $sort_type)
            ->paginate(12)
            ->withQueryString();


        $models = '';
        if (isset(request()->make)) {
            $models = Model::whereHas('division', function ($query) {
                $query->where('name', request()->make);
            })->groupBy('name')->get();
        }
        return view('frontend.search', [
            'vehicles' => $vehicles,
            'years' => [date('Y') - 1, date('Y')],
            'makes' => isset(request()->year) ? Division::where('year', request()->year)->groupBy('name')->get() : '',
            'models' => $models,
            'engine_types' => array_flip($this->types('engine_types')),
            'body_types' => array_flip($this->types('body_types')),
            'fuel_types' => array_flip($this->types('fuel_types')),
            'drivetrain' => $drivetrain,
            'banner' => Banner::where("page_id", 9)->first(),
        ]);
    }

    public function clean_wp_content($content)
    {
        // Remove wp:paragraph comments
        $content = preg_replace('/<!-- wp:paragraph -->/', '', $content);
        // Remove opening and closing <p> tags
        $content = preg_replace('/<p>/', '', $content);
        $content = preg_replace('/<\/p>/', '', $content);
        $content = str_replace('<!-- /wp:paragraph -->', '', $content);
        
        return $content;
    }
}
