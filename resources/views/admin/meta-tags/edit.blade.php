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
                        <h4 class="pb-2">{{ str_replace('frontend.', '', $metatags->route_name) }}</h4>
                        <form method="POST" action="{{ route('admin.metaTags.update', $metatags->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="Text" class="form-control" value="{{ $metatags->title }}"
                                    name="title">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control"
                                    name="description" rows="3">{{ $metatags->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keywords</label>
                                <textarea class="form-control"
                                    name="keywords" rows="3">{{ $metatags->keywords }}</textarea>
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
