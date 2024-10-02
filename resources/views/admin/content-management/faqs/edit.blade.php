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
                        <h4 class="pb-2">{{ $faqs->question }}</h4>
                        <form method="POST" action="{{ route('admin.faqs.update', $faqs->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Question</label>
                                <input type="Text" required class="form-control" value="{{ $faqs->question }}"
                                    name="question">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea required rows="6" class="form-control"
                                    name="description">{{ $faqs->description }}</textarea>
                            </div>
                            <div class="mb-3">
                            <label class="form-label">Sort Order</label>
                                <select name="sort" class="form-control">
                                    <option value="">Select Sort</option>
                                    @for ($i = 1; $i <= $count; $i++)
                                        <option value="{{$i}}" {{ $faqs->sort == $i ? 'selected="selected"' : '' }}>{{$i}}</option>
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
