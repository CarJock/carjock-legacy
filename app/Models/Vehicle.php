<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'year',
        'division',
        'model',
        'style',
        'style_id',
        'style_number',
        'fuel_type_id',
        'engine_type_id',
        'body_type',
        'data',
        'image',
        'featured',
        'horsepower', 'torque', 'pricing', 'seating', 'battery_range', 'mpg_city', 'mpg_hwy',
        'length_overall', 'width_overall', 'height_overall', 'cargo_volume', 'trunk_volume',
        'front_head_room', 'front_leg_room', 'second_head_room', 'second_leg_room', 'second_shoulder',
        'garage'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data' => 'json'
    ];

    public function fuel_type()
    {
        return $this->belongsTo(FuelType::class);
    }

    public function engine_type()
    {
        return $this->belongsTo(EngineType::class);
    }

    public function style()
    {
        return $this->belongsTo(Style::class);
    }

    public function images()
    {
        return $this->hasMany(VehicleImage::class, 'style_id');
    }

    /**
     * Favourite vehicle or my garage
     */
    public function user()
    {
        if(Auth::check())
            return $this->belongsToMany(User::class)->where('type', 'favourite')->where('user_id', auth()->user()->id);
        else
            return $this->belongsToMany(User::class)->where('type', 'favourite');
    }
}
