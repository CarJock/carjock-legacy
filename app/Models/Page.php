<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Banner as BannerModel;
use App\Models\PageContent as PageContentModel;
use App\Models\Ads as AdsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    public function banners()
    {
        return $this->hasOne(BannerModel::class);
    }

    public function pagecotents()
    {
        return $this->hasMany(PageContentModel::class);
    }

}
