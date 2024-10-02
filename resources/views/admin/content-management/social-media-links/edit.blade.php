@extends('admin.layouts.app')
@section('content')
    {{-- Message --}}




    <div class="container">
        <div class="row">
            <div class="col-6 m-auto mt-5 pt-5">

                @if ($message = Session::get('message'))
                    <div class="alert alert-success alert-block">
                        {{ $message }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h4 class="pb-2">Social Media Links</h4>
                        <form method="POST" action="{{ route('admin.media.update', $social->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Platform</label>
                                <input type="text" class="form-control" value="{{ $social->social_name }}"
                                    name="social_name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Url</label>
                                <input type="text" class="form-control" value="{{ $social->social_link }}"
                                    name="social_link">
                            </div>
                            <div class="mb-3">
                            <label class="form-label">Sort Order</label>
                                <select name="sort" class="form-control">
                                    <option value="">Select Sort</option>
                                    @for ($i = 1; $i <= $count; $i++)
                                        <option value="{{$i}}" {{ $social->sort == $i ? 'selected="selected"' : '' }}>{{$i}}</option>
                                    @endfor
                                </select>
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
