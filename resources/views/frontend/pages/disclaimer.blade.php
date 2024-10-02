@extends('frontend.layouts.app')

@section('content')
<div class="mainBanner bannerheightadjust"
    style="background-image:url({{ url('storage/banners/'.$banner->image) }}); background-size: cover; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row">
            <div class="mainbanneroverlay">
                <h2>DISCLAIMER</h2>
                <div class="breadcrumb">
                    <ul>
                        <li>Home</li>
                        <li>Disclaimer</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="dis_claimer py-5">

    <div class="container">

        <div class="col-md-12">
            <h2>{{$disclaimer->heading}}</h2>
            <p>{!! $disclaimer->content !!}</p>    
        </div>
    </div>

</section>

@endsection