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
                        <h4 class="pb-2">{{ $vehicle->name }}</h4>
                        <form method="POST" action="{{ route('admin.vehicles.update', $vehicle->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="Text" disabled required class="form-control" value="{{ $vehicle->name }}"
                                    name="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Body Type</label>
                                <input type="Text" disabled required class="form-control"
                                    value="{{ $vehicle->body_type }}" name="">
                            </div>
                            {{-- <div class=" mb-2 mt-3">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Feature This
                                </label>
                                <br>
                                <input class="form-radio-input" type="checkbox" value="1" id="feature"
                                    name="feature">
                            </div> --}}

                            <div class=" mb-2 mt-3">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Feature This
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" name="feature" value="yes" type="radio"
                                    name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="feature" value="no"
                                    name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    No
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
