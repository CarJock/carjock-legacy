@extends('admin.layouts.app')
@section('content')
    {{-- Message --}}
    <div class="container">
        <div class="row">
            <div class="col-6 m-auto mt-5 pt-5">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        {{ $message }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h4 class="pb-2">{{ $banners->pages->title }}</h4>
                        <form method="POST" action="{{ route('admin.banners.update', $banners->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Heading</label>
                                <input type="Text" class="form-control" value="{{ $banners->heading }}"
                                    name="heading">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <textarea class="form-control"
                                    name="content" rows="6">{{ $banners->content }}</textarea>
                            </div>
                            <div class="mb-3">
                                @php
                                    if ($banners->id == 1) 
                                        $image_size = "1590 * 540";
                                    else if ($banners->id == 4)
                                        $image_size = "1590 * 395";
                                    else
                                        $image_size = "1590 * 415";
                                @endphp    
                                <label class="form-label">Image  <b>({!! $image_size !!})</b></label>
                                <input type="file" class="form-control" name="image" accept="image/*" id="banner_img"/>
                                <br>
                                <div class="banner-scrollable-container">
                                    <div class="banner-image-container">
                                        <img src="{{ url('storage/banners/'.$banners->image) }}" id="ads_banner_img">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
