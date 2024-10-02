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
                        <h4 class="pb-2">Create New</h4>
                        <form method="POST" action="{{ route('admin.faqs.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Question</label>
                                <input type="Text" required class="form-control" placeholder="Question" name="question">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea required class="form-control" placeholder="Description"
                                    name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sort Order</label>
                                <input type="Text" required class="form-control" name="sort" value="{{$count+1}}" readonly>
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
