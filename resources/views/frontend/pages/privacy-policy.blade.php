@extends('frontend.layouts.app')

@section('content')
<div class="mainBanner bannerheightadjust"
    style="background-image:url({{url('storage/banners/'.$banner->image) }}); background-size: cover; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row">
            <div class="mainbanneroverlay">
                <h2>PRIVACY POLICY</h2>
                <div class="breadcrumb">
                    <ul>
                        <li>Home</li>
                        <li>Privacy Policy</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="dis_claimer">
    <div class="container py-5">

        <div class="col-md-12">
            <h2>{{$privacy->heading}}</h2>
            <p>{!! $privacy->content !!}</p> 
        </div>
    </div>
</section>

@endsection