@extends('admin.layouts.app')
@section('content')
    {{-- Message --}}




    <div class="container">
        <div class="row">
            <div class="col-6 m-auto mt-5 pt-5">

                @if ($message = Session::get('message'))
                    <div class="alert alert-danger alert-block">
                        {{ $message }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h4 class="pb-2">Create New</h4>
                        <form method="POST" action="{{ route('admin.ads.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <select name="page_id" required class="form-control" id="ads_page_id">
                                    <option value="">Select Page</option>
                                    @foreach($pages as $page)
                                        <option {{ old('page_id') == $page->id ? 'selected' : '' }} value="{{$page->id}}">{{ $page->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <select name="slot" class="form-control" id="ads_slot_id">
                                    <option value="">Select Slot</option>
                                    <option value="1">featured vehicles</option>
                                    <option value="2">news from blog</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Link</label>
                                <input type="text" required name="link" class="form-control" value="{{ old('link') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Start Date</label>
                                <input type="text" required name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">End Date</label>
                                <input type="text" required id ="end_date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                            </div>
                            <div class="mb-3">
                                <select name="start_time" class="form-control">
                                    <option value="">Select Start Time</option>
                                    @for ($i = 1; $i <= 24; $i++)
                                        <option {{ old('start_time') == $i ? 'selected' : '' }} value="{{$i}}">@php echo sprintf('%02d', $i) . ":00" @endphp</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <select name="end_time" class="form-control">
                                    <option value="">Select End Time</option>
                                    @for ($i = 1; $i <= 24; $i++)
                                        <option {{ old('end_time') == $i ? 'selected' : '' }} value="{{$i}}">@php echo sprintf('%02d', $i) . ":00" @endphp</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image <b id="ads_size"></b></label>
                                <input type="file" class="form-control" name="image" accept="image/*" id="ads_img"/>
                            </div>
                            <div class="mb-3">
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option {{ old('status') == 'active' ? 'selected' : '' }} value="active">Active</option>
                                    <option {{ old('status') == 'inactive' ? 'selected' : '' }} value="inactive">Inactive</option>
                                </select>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    </div>
@endsection