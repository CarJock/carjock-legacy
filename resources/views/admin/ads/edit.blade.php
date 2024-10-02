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
                        <h4 class="pb-2">Ads {{ $ads->title }}</h4>
                        <form method="POST" action="{{ route('admin.ads.update', $ads->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <input type="Text" readonly class="form-control" value="{{ $ads->title }}"
                                    name="page_title">
                                <input type="hidden" readonly class="form-control" value="{{ $ads->page }}"
                                    name="page">
                            </div>

                            @if($ads->slot != "")
                            <div class="mb-3">
                                <label class="form-label">Slot</label>
                                @php
                                    if($ads->slot == 1){
                                        $slot_name = "featured vehicles";
                                    } elseif($ads->slot == 2) {
                                        $slot_name = "news from blog";
                                    } else {
                                        $slot_name = "";
                                    }
                                @endphp
                                <input type="Text" readonly class="form-control" value="{{ $slot_name }}"
                                    name="slot_name">
                                <input type="hidden" readonly class="form-control" value="{{ $ads->slot }}"
                                    name="slot">
                            </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label">Start Date</label>
                                <input type="text" required name="start_date" id="start_date" class="form-control" value="{!! date('d/m/Y', strtotime($ads->start_date)) !!}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">End Date</label>
                                <input type="text" required id ="end_date" name="end_date" class="form-control" value="{!! date('d/m/Y', strtotime($ads->end_date)) !!}">
                            </div>
                            <div class="mb-3">
                                <select name="start_time" class="form-control">
                                    <option value="">Select Start Time</option>
                                    @for ($i = 1; $i <= 24; $i++)
                                        <option {{ $ads->start_time == $i ? 'selected="selected"' : '' }} value="{{$i}}">@php echo sprintf('%02d', $i) . ":00" @endphp</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <select name="end_time" class="form-control">
                                    <option value="">Select End Time</option>
                                    @for ($i = 1; $i <= 24; $i++)
                                        <option {{ $ads->end_time == $i ? 'selected="selected"' : '' }} value="{{$i}}">@php echo sprintf('%02d', $i) . ":00" @endphp</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" accept="image/*" id="ads_img"/>
                                <br>
                                <img src="{{ url('storage/ads/'.$ads->image) }}" id="ads_show_img" height="200" width="200">
                            </div>
                            <select name="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="active" {{ $ads->status == 'active' ? 'selected="selected"' : '' }}>Active</option>
                                <option value="inactive" {{ $ads->status == 'inactive' ? 'selected="selected"' : '' }}>Inactive</option>
                            </select>
                    </div>
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
